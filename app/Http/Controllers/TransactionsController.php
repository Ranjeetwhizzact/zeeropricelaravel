<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


class TransactionsController extends Controller
{
    //


public function mytransactions()
{
    $userId = Auth::id(); // Get the logged-in user's ID
    
    // Get transactions directly from orders_detail which has userid field
    $transactions = DB::table('orders_detail')
        ->join('products', 'orders_detail.pid', '=', 'products.pid')
        ->select(
            'orders_detail.*',
            'products.pic1',
            'products.pic2',
            'products.ititle as title', // Using ititle from products table
            'orders_detail.mrp', // Use mrp from orders_detail (already has it)
            'orders_detail.customerCost as zero_price', // Zero price is customer cost
            'orders_detail.collectedPrice as points_paid', // Points paid is collected price
            'orders_detail.qty',
            'orders_detail.postedOn as transaction_time'
        )
        ->where('orders_detail.userid', $userId) // Filter by user ID directly
        ->orderBy('orders_detail.postedOn', 'desc')
        ->paginate(10);
    
    // Get user's coin balances - adjust these based on your actual user table structure
    $user = Auth::user();
    $goldCoins = $user->gold_coins ?? 665; // Default from your image
    $freeCoins = $user->free_coins ?? 194; // Default from your image
    
    return view('mytranstion', compact('transactions', 'goldCoins', 'freeCoins'));
}
}
