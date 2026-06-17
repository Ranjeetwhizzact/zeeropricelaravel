<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pointspackage;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;
use App\Models\User;
class CashfreeController extends Controller
{




public function createOrder(Request $request)
{
    $request->validate([
        'package_id' => 'required|exists:pointspackage,id'
    ]);

    $user = auth()->user();

    $package = Pointspackage::findOrFail($request->package_id);

    $orderId = $user->id . now()->format('YmdHis');

    $payload = [
        "order_id" => $orderId,
        "order_amount" => $package->cost,
        "order_currency" => $package->currency ?? 'INR',
        "order_note" => $package->packagename . " Coins:" . $package->points,
        "customer_details" => [
            "customer_id" => (string) $user->id,
            "customer_name" => $user->name,
            "customer_email" => $user->email ?? 'info@yourdomain.com',
            "customer_phone" => $user->phone
        ],
        "order_meta" => [
            "return_url" => route('cashfree.return', ['order_id' => $orderId]),
        ]
    ];

    $response = Http::withHeaders([
        'accept' => 'application/json',
        'content-type' => 'application/json',
        'x-api-version' => '2022-09-01',
        'x-client-id' => config('services.cashfree.client_id'),
        'x-client-secret' => config('services.cashfree.client_secret'),
    ])->post('https://sandbox.cashfree.com/pg/orders', $payload);

    if (!$response->successful() || !isset($response['payment_session_id'])) {
        return redirect()->route('wallet')
            ->with('error', $response->json()['message'] ?? 'Payment initiation failed');
    }

    Transaction::create([
        'userid'        => $user->id,
        'transactionid' => $orderId,
        'amount'        => $package->cost,
        'currency'      => $package->currency ?? 'INR',
        'credited'      => $package->points,
        'debited'       => 0,
        'remark'        => $package->packagename,
        'isPaid'        => 0,
        'postedon'      => now(),
    ]);

    return view('processing', [
        'paymentSessionId' => $response['payment_session_id']
    ]);
}




public function return(Request $request)
{
    $orderId = $request->order_id;

    if (!$orderId) {
        return redirect()->route('wallet')->with('error', 'Invalid order ID');
    }

    $response = Http::withHeaders([
        'x-client-id' => config('services.cashfree.client_id'),
        'x-client-secret' => config('services.cashfree.client_secret'),
        'x-api-version' => '2021-05-21',
    ])->get("https://sandbox.cashfree.com/pg/orders/{$orderId}");

    if (!$response->successful()) {
        return redirect()->route('wallet')->with('error', 'Unable to verify payment');
    }

    $result = $response->json();

    if (($result['order_status'] ?? '') !== 'PAID') {
        return redirect()->route('wallet')->with('error', 'Order has not been paid');
    }

    $transaction = Transaction::where('transactionid', $orderId)->first();

    if (!$transaction || $transaction->isPaid) {
        return redirect()->route('wallet')->with('error', 'Transaction already processed');
    }

  $user = User::where('id', $transaction->userid)->first();

    if (!$user) {
        return redirect()->route('wallet')->with('error', 'User not found');
    }

    $user->points += $transaction->credited;
    $user->save();

    $transaction->update([
        'isPaid' => 1,
        'postedon' => now(),
    ]);

    return redirect()->route('wallet')
        ->with('success', 'Payment successful! Coins added.');
}

// public function notify(Request $request)
// {
//     return response()->json(['status' => 'ok']);
// }

}
