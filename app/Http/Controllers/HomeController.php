<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function viewhome(Request $request)
{
    $searchkey = $request->input('search');

        $query = Product::query();

        if ($searchkey) {
            $query->where(function ($q) use ($searchkey) {
                $q->where('ititle', 'like', "%{$searchkey}%")
                  ->orWhere('description', 'like', "%{$searchkey}%");
            });
        }

        $products = $query->where('istatus', 1)
                          ->where('qty', '>', 0)
                          ->where('reducedPrice', '>', 0)
                          ->whereDate('tilldate', '>=', now())
                          ->orderBy('pid', 'desc')
                          ->get();

        // return view('products.index', compact('products'));
    return view('index',compact('products'));
}
}
