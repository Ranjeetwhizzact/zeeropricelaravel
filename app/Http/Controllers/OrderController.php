<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Freepoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    //
public function myorders()
{

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $orders = OrderDetail::where('userid', Auth::id())->latest()->get();

    return view('order', compact('orders'));
}


}
