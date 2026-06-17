<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    //

        public function showLogin()
    {
        return view('admin.auth.login');
    }


public function login(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'password' => 'required'
    ]);

    $admin = User::where('phone', $request->phone)->first();

    if(!$admin){
        return "Admin not found with this phone number";
    }
    if(!Hash::check($request->password, $admin->password)){
        return "Password does not match";
    }

    if(Auth::guard('admin')->attempt([
        'phone' => $request->phone,
        'password' => $request->password
    ])){
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return "Auth Attempt Failed";
}

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}