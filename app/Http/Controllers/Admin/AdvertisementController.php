<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdClick;
use App\Models\AdPackage;
use App\Models\AdRevenueSplit;
use App\Models\AdTask;
use App\Models\AdTaskCompletion;
use App\Models\Advertisement;
use App\Models\BuyerAdSlot;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\UserAdCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdvertisementController extends Controller
{
    public function packages()
    {
        $packages = AdPackage::all();
        return view('admin.ads.packages', compact('packages'));
    }

    public function pay(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:ad_packages,id',
        ]);

        $user = auth('web')->user();
        $package = AdPackage::findOrFail($request->package_id);

        session([
            'package_data' => [
                'ads_count' => $package->ads_count,
                'amount'    => $package->price,
            ]
        ]);

        $orderId = $user->id . now()->format('YmdHis');

        $payload = [
            "order_id" => $orderId,
            "order_amount" => $package->price,
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => (string)$user->id,
                "customer_name" => $user->name,
                "customer_email" => $user->email,
                "customer_phone" => $user->phone
            ],
            "order_meta" => [
                "return_url" => route('ads.payment.return', ['order_id' => $orderId]),
            ]
        ];

        $response = Http::withHeaders([
            'x-api-version' => '2022-09-01',
            'x-client-id' => config('services.cashfree.client_id'),
            'x-client-secret' => config('services.cashfree.client_secret'),
        ])->post('https://sandbox.cashfree.com/pg/orders', $payload);

        if (!$response->successful() || !isset($response['payment_session_id'])) {
            return back()->with('error', 'Payment failed');
        }

        Transaction::create([
            'userid'        => $user->id,
            'transactionid' => $orderId,
            'amount'        => $package->price,
            'currency'      => 'INR',
            'credited'      => 0,
            'debited'       => $package->price,
            'remark'        => 'Ad Package Purchase',
            'isPaid'        => 0,
            'postedon'      => now(),
        ]);

        return view('processing', [
            'paymentSessionId' => $response['payment_session_id']
        ]);
    }

    public function paymentReturn(Request $request)
    {
        $orderId = $request->order_id;

        $response = Http::withHeaders([
            'x-client-id' => config('services.cashfree.client_id'),
            'x-client-secret' => config('services.cashfree.client_secret'),
            'x-api-version' => '2021-05-21',
        ])->get("https://sandbox.cashfree.com/pg/orders/{$orderId}");

        if (!$response->successful()) {
            return redirect()->route('ads.packages')->with('error', 'Verification failed');
        }

        $result = $response->json();

        if (($result['order_status'] ?? '') !== 'PAID') {
            return redirect()->route('ads.packages')->with('error', 'Payment not completed');
        }

        $transaction = Transaction::where('transactionid', $orderId)->first();

        if (!$transaction || $transaction->isPaid) {
            return redirect()->route('ads.packages')->with('error', 'Already processed');
        }

        $data = session('package_data');

        if (!$data) {
            return redirect()->route('ads.packages')->with('error', 'Session expired');
        }

        $user = auth('web')->user();

        // ✅ Create or update credit
        $credit = UserAdCredit::firstOrCreate(
            ['user_id' => $user->id],
            ['total_credits' => 0, 'used_credits' => 0]
        );

        $credit->increment('total_credits', $data['ads_count']);

        $transaction->update(['isPaid' => 1]);

        session()->forget('package_data');

        return redirect()->route('ads.create')
            ->with('success', 'Credits added successfully!');
    }

    public function index()
    {
        $userId = auth('web')->id();

        $ads = Advertisement::where('seller_id', $userId)
            ->latest()
            ->get();

        $advertisements = Advertisement::where('seller_id', $userId)
            ->with([
                'tasks' => function ($query) {
                    $query->withCount('completions');
                }
            ])
            ->get();

        // ✅ Fetch user credits
        $credit = UserAdCredit::where('user_id', $userId)->first();

        $remainingCredits = 0;

        if ($credit) {
            $remainingCredits = $credit->total_credits - $credit->used_credits;
        }

        return view('admin.ads.index', compact(
            'ads',
            'advertisements',
            'remainingCredits'
        ));
    }

    public function analytics($id)
    {
        $ad = Advertisement::with(['tasks.user'])->findOrFail($id);

        $likes = $ad->tasks->where('task_type', 'like')->count();

        $facebookShares = $ad->tasks
            ->where('task_type', 'share')
            ->filter(function ($task) {
                return str_contains(strtolower($task->task_details), 'facebook');
            })
            ->count();

        $whatsappShares = $ad->tasks
            ->where('task_type', 'share')
            ->filter(function ($task) {
                return str_contains(strtolower($task->task_details), 'whatsapp');
            })
            ->count();

        $comments = $ad->tasks->where('task_type', 'comment')->count();

        return view('admin.ads.analytics', compact(
            'ad',
            'likes',
            'facebookShares',
            'whatsappShares',
            'comments'
        ));
    }

    public function create()
    {
        $userId = auth('web')->id();

        $credit = UserAdCredit::where('user_id', $userId)->first();

        if (!$credit || ($credit->total_credits - $credit->used_credits) <= 0) {
            return redirect()->route('ads.packages')
                ->with('error', 'Please buy ad package first');
        }
        $products = Product::where('sellerid', $userId)->get();

        return view('admin.ads.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|exists:products,pid',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm,ogg|max:20480',
        ]);

        $userId = auth('web')->id();

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $ext = strtolower($file->getClientOriginalExtension());

            $mediaType = in_array($ext, ['mp4', 'webm', 'ogg']) ? 'video' : 'image';

            $filename = time() . '_' . uniqid() . '.' . $ext;
            $file->move(public_path('ads'), $filename);

            $mediaPath = 'ads/' . $filename;
        }

        Advertisement::create([
            'seller_id'  => $userId,
            'product_id' => $request->product_id,
            'title'      => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'media_type' => $mediaType,
            'media_url'  => $mediaPath,
            'status'     => 'active',
        ]);

        // ✅ deduct credit
        $credit = UserAdCredit::where('user_id', $userId)->first();
        $credit->increment('used_credits');

        return redirect()->route('ads.index')
            ->with('success', 'Ad created successfully!');
    }

    public function edit($id)
    {
        $ad = Advertisement::findOrFail($id);
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request, $id)
    {
        $ad = Advertisement::findOrFail($id);
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'budget'      => 'nullable|numeric|min:1',
            'media'       => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm,ogg|max:20480',
        ]);

        $data = $request->only(['title', 'description', 'budget']);
        $budget = (int) $request->budget;

        $data['max_clicks'] = $budget;
        $data['max_likes']  = floor($budget * 0.5);
        $data['max_shares'] = floor($budget * 0.5);
        if ($ad->total_clicks > $data['max_clicks']) {
            return back()->withErrors([
                'budget' => 'Budget too low. Already used clicks exceed new limit.'
            ]);
        }
        if ($request->hasFile('media')) {
            if ($ad->media_url && file_exists(public_path($ad->media_url))) {
                unlink(public_path($ad->media_url));
            }

            $file = $request->file('media');
            $ext  = strtolower($file->getClientOriginalExtension());

            $data['media_type'] = in_array($ext, ['mp4', 'webm', 'ogg']) ? 'video' : 'image';

            $filename = time() . '_' . uniqid() . '.' . $ext;
            $file->move(public_path('ads'), $filename);

            $data['media_url'] = 'ads/' . $filename;
        }
        $ad->update($data);

        return redirect()
            ->route('ads.index')
            ->with('success', 'Ad Updated Successfully');
    }

    public function destroy($id)
    {
        Advertisement::findOrFail($id)->delete();
        return redirect()->route('ads.index')->with('success', 'Ad Deleted');
    }

    public function clickAd(Request $request)
    {
        $buyer_id = Auth::id();
        $alreadyClicked = AdClick::where('buyer_id', $buyer_id)
            ->where('ad_id', $request->ad_id)
            ->exists();

        if ($alreadyClicked) {
            return back()->with('error', 'You already viewed this ad');
        }

        $slots = BuyerAdSlot::where('buyer_id', $buyer_id)
            ->where('status', 'pending')
            ->count();

        if ($slots >= 4) {
            return back()->with('error', 'Complete previous ads first');
        }

        AdClick::create([
            'ad_id' => $request->ad_id,
            'buyer_id' => $buyer_id,
            'product_id' => $request->product_id,
            'is_reward_given' => 0
        ]);

        BuyerAdSlot::create([
            'buyer_id' => $buyer_id,
            'ad_id' => $request->ad_id
        ]);

        return back()->with('success', 'Ad viewed! Complete the tasks to earn rewards.');
    }

    public function adsdashboard()
    {
        $slots = BuyerAdSlot::where('buyer_id', Auth::id())
            ->where('status', 'pending')
            ->with('advertisement')
            ->get();

        return view('admin.ads.dashboard', compact('slots'));
    }

    public function showAd($slotId)
    {
        $slot = BuyerAdSlot::with('advertisement')->findOrFail($slotId);
        $ad = $slot->advertisement;

        // ✅ Store start time (timestamp = safer)
        session([
            'ad_start_time' => time(),
            'ad_slot_id' => $slotId
        ]);

        return view('admin.ads.view', compact('slot', 'ad'));
    }

    public function completeTask(Request $request)
    {
        $slot = BuyerAdSlot::with('advertisement')->findOrFail($request->slot_id);

        $startTime = session('ad_start_time');

        if (!$startTime || (time() - $startTime) < 30) {
            return redirect()->back()->with('error', 'You must watch full ad for 30 seconds');
        }
        Log::info(auth('web')->id() . ' completed ' . $request->action . ' for ad ' . $slot->ad_id);
        DB::beginTransaction();

        try {

            // ✅ 1. Track click
            $click = AdClick::create([
                'ad_id' => $slot->ad_id,
                'buyer_id' => auth('web')->id(),
                'product_id' => $slot->advertisement->product_id,
                'is_reward_given' => 1
            ]);

            // ✅ 2. STORE TASK (ACTIVITY LOG)
            AdTask::create([
                'ad_id' => $slot->ad_id,
                'user_id' => auth('web')->id(), // ✅ store user
                'task_type' => strtolower($request->action),
                'task_details' => $request->action == 'share'
                    ? 'Shared on ' . $request->platform
                    : ucfirst($request->action) . ' completed',
                'comment_text' => $request->action == 'comment'
                    ? $request->comment_text
                    : null,
                'reward' => 5
            ]);

            // ✅ 3. Revenue split
            AdRevenueSplit::create([
                'click_id' => $click->click_id,
                'total_amount' => 10,
                'buyer_reward' => 5,
                'product_reduction' => 2,
                'ad_product_reduction' => 1,
                'platform_earning' => 2
            ]);

            // ✅ 4. Give points
            DB::table('pointstransaction')->insert([
                'userid' => auth('web')->id(),
                'orderid' => 0,
                'points' => 5,
                'pid' => $slot->advertisement->product_id,
                'sellerid' => 0,
                'mrp' => 0,
                'reducedPrice' => 0,
                'source' => 'ad'
            ]);

            // ✅ 5. Update slot
            $slot->update(['status' => 'completed']);

            DB::commit();

            return redirect()->route('ads.dash')
                ->with('success', '🎉 Task completed + points credited!');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
