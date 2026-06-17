<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pointspackage;
class GoldCoinController extends Controller
{
    //
     public function index()
    {
        // Fetch only active packages
        $packages = Pointspackage::where('istatus', 1)->get();

        return view('goldcoins', compact('packages'));
    }
       public function confirm(Request $request)
    {
        $package = Pointspackage::findOrFail($request->package_id);
        return view('confirm', compact('package'));
    }
}
