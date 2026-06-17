<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Freepoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    //
    public function soldproducts()
    {
        $soldProducts = DB::table('orders_detail')
            ->join('products', 'orders_detail.pid', '=', 'products.pid')
            ->select(
                'orders_detail.*',
                'products.pic1',
                'products.pic2',
                'products.ititle as product_title'  // Changed from 'title' to 'ititle'
            )
            ->where('orders_detail.isDelivered', '0')
            ->where('orders_detail.isCancelled', '0')
            ->orderBy('orders_detail.postedon', 'desc')
            ->paginate(10);

        return view('soldproduct', compact('soldProducts'));
    }

    public function confirmDelivery($id, Request $request)
    {
        $request->validate(['otp' => 'required|string|max:6']);

        $order = DB::table('orders_detail')->where('id', $id)->first();

        // Verify OTP logic here
        if ($order->otp == $request->otp) {
            DB::table('orders_detail')
                ->where('id', $id)
                ->update([
                    'isDelivered' => 1,
                    'updated_at' => now()
                ]);

            return redirect()->back()->with('success', 'Delivery confirmed successfully!');
        }

        return redirect()->back()->with('error', 'Invalid OTP!');
    }

    public function cancelOrder($id)
    {
        DB::table('orders_detail')
            ->where('id', $id)
            ->update([
                'isCancelled' => 1,
                'cancelledOn' => now(),
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Order cancelled successfully!');
    }
    public function addproducts()
    {
        $cat = Category::all();   // or Category::get();
        return view('addproduct', ['cat' => $cat]);
    }

    public function store(Request $request, $id = null)
    {
        try {
            // 🔍 Log incoming request (VERY IMPORTANT)
            Log::info('Product Store Request:', $request->all());

            // 1. Find or New
            if ($id) {
                $product = Product::where('pid', $id)->first();
            } else {
                $product = new Product();
            }

            // 2. Assign Fields
            $product->sellerid = Auth::id(); // ⚠️ fixed auth('')
            $product->catid = $request->catid;
            $product->subcatid = $request->subcatid;
            $product->ititle = $request->input('product-name');
            $product->description = $request->description;
            $product->mrp = $request->input('max-price');
            $product->minprice = $request->input('min-price');
            $product->reducedprice = $request->input('discount');
            $product->qty = $request->quantity;
            $product->collectedprice = 0;
            $product->currency = "INR";
            $product->tilldate = $request->input('display-till');
            $product->postedon = now();
            $product->ip = $request->ip();
            $product->isactive = 1;
            $product->issold = 0;
            $product->istatus = 1;

            // 3. Handle Images
            if ($request->hasFile('file-upload')) {
                $images = $request->file('file-upload');

                foreach ($images as $index => $image) {
                    if ($index < 5) {
                        $name = time() . "_" . $index . "." . $image->extension();
                        $image->move(public_path('product_images'), $name);

                        $columnName = 'pic' . ($index + 1);
                        $product->$columnName = $name;
                    }
                }
            }

            $product->save();

            Log::info('Product saved successfully', ['pid' => $product->pid]);

            return back()->with('success', 'Product saved successfully!');
        } catch (\Exception $e) {

            // ❗ Log full error
            Log::error('Product Save Error: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit($pid)
    {
        $product = Product::findOrFail($pid);
        $cat = Category::all();
        return view('addproduct', compact('product', 'cat'));
    }

    public function getSubcategories($id)
    {
        return SubCategory::where('catid', $id)->get();
    }
    public function productdetail(Request $request, $id)
    {
        $product = Product::where('pid', $id)->first();

        if (!$product) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Product not found'], 404);
            }
            abort(404);
        }

        $user = Auth::user(); // ✅ correct way
        $freepoint = Freepoints::where('userid', $user?->id)->first();
        $userpoint = $user?->points ?? 0;
        $adPoints = DB::table('pointstransaction')
            ->where('userid', auth('web')->id())
            ->where('source', 'ad')
            ->sum('points');

        // Fetch comments related to the advertisements of this product
        $comments = \App\Models\AdTask::with('user')
            ->where('task_type', 'comment')
            ->whereHas('advertisement', function ($query) use ($id) {
                $query->where('product_id', $id);
            })
            ->orderBy('task_id', 'desc')
            ->get();

        if ($request->expectsJson()) {
            return response()->json([
                'product'    => $product,
                'freepoint'  => $freepoint,
                'userpoint'  => $userpoint,
                'adPoints'   => $adPoints,
                'comments'   => $comments,
            ]);
        }

        return view('productdetail', compact(
            'product',
            'freepoint',
            'userpoint',
            'adPoints',
            'comments'
        ));
    }
    public function hitSecondAPI(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not logged in'
            ], 401);
        }

        $updated = Freepoints::where('userid', $user->id)
            ->where('points', '>', 0)
            ->decrement('points', 1);

        if (!$updated) {
            return response()->json([
                'message' => 'Not enough silver coins'
            ], 400);
        }

        // get updated value
        $remaining = Freepoints::where('userid', $user->id)->value('points');

        return response()->json([
            'message' => 'Silver coin deducted',
            'remaining_points' => $remaining
        ]);
    }


    public function productdetailApi($id)
    {
        $product = Product::where('pid', $id)->first();

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $freepoint = Freepoints::where('userid', auth('')->id())->first();

        return response()->json([
            'product'   => $product,
            'freepoint' => $freepoint
        ]);
    }

    public function myproducts()
    {
        $products = Product::where('sellerid', Auth::id())->get();

        return view('myproduct', compact('products'));
    }
    public function destroy($id)
    {
        $product = Product::where('pid', $id)->first();
        if ($product->sellerid !== auth('')->id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }




    public function goldcoin(Request $request, $pid)
    {
        $userId = auth('')->id();

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not logged in'
            ], 401);
        }

        try {
            DB::transaction(function () use ($userId, $pid) {

                // 1️⃣ Deduct user point
                User::where('id', $userId)->decrement('points', 1);

                // 2️⃣ Deduct product point (USE pid)
                DB::transaction(function () use ($pid) {

                    $product = Product::where('pid', $pid)
                        ->lockForUpdate()
                        ->first();

                    // ⛔ Stop if no stock
                    if (!$product || $product->qty <= 0) {
                        throw new \Exception('Out of stock');
                    }

                    // ✅ Case 1: reducedPrice > 0
                    if ($product->reducedPrice > 0) {

                        $product->reducedPrice -= 1;
                        $product->collectedprice += 1;
                    }

                    // ✅ Case 2: reducedPrice == 0
                    if ($product->reducedPrice == 0) {

                        // reset reduced price to mrp
                        $product->reducedPrice = $product->mrp;

                        // decrease quantity
                        $product->qty -= 1;

                        // ⛔ Stop if qty just reached 0
                        if ($product->qty < 0) {
                            throw new \Exception('Stock exhausted');
                        }
                    }

                    $product->save();
                });
                // 3️⃣ Increase freepoints (update or create)
                $freepoint = Freepoints::where('userid', $userId)
                    ->lockForUpdate()
                    ->first();

                if ($freepoint) {
                    $freepoint->increment('points', 4);
                } else {
                    Freepoints::create([
                        'userid'   => $userId,
                        'points'   => 4,
                        'postedon' => now()->toDateString(),
                    ]);
                }
            });

            return response()->json([
                'success' => true,
                'message' => '4 free points added'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function mystore()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get only logged in seller products
        $products = Product::where('sellerid', Auth::id())->get();

        return view('myproduct', compact('products'));
    }

    public function adsCoin($productId)
    {
        $user = auth('web')->user();

        $adsPoints = DB::table('pointstransaction')
            ->where('userid', $user->id)
            ->where('source', 'ad')
            ->sum('points');

        if ($adsPoints <= 0) {
            return response()->json(['message' => 'No ad coins available'], 400);
        }

        // deduct 1 coin
        DB::table('pointstransaction')->insert([
            'userid' => $user->id,
            'points' => -1,
            'source' => 'ad',
            'created_at' => now()
        ]);

        return response()->json(['message' => 'Ad coin used']);
    }

    public function usePurpleCoin(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not logged in'
            ], 401);
        }

        // ✅ Get total purple coins (orderid = 0)
        $totalPoints = DB::table('pointstransaction')
            ->where('userid', $user->id)
            ->where('orderid', 0)
            ->sum('points');

        if ($totalPoints <= 0) {
            return response()->json([
                'message' => 'Not enough purple coins'
            ], 400);
        }
        $product = Product::findOrFail($request->product_id);

        // ✅ Deduct 1 coin by inserting negative entry
        DB::table('pointstransaction')->insert([
            'userid'   => $user->id,
            'pid' => $request->product_id,
            'sellerid' => $product->sellerid,
            'mrp'      => $product->mrp,
            'reducedprice' => $product->reducedPrice,
            'points'   => -1,
            'orderid'  => 0,
            'source'   => 'ad',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'message' => 'Purple coin deducted',
            'remaining_points' => $totalPoints - 1
        ]);
    }
}
