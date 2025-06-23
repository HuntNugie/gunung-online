<?php

namespace App\Http\Controllers\admin\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate([
            "email" => 'required | email | exists:admins,email',
            'password' => 'required',
        ]);
        $remember = $request->filled("remember");
        $credential = $request->only("email","password");
        if(Auth::guard("admin")->attempt($credential,$remember)){
            return redirect()->intended(route("dashboard"));
        }
        return redirect()->back()->withErrors(["gagal" => "Gagal login"]);
    }
}
