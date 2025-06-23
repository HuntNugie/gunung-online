<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

Route::get('/', function () {
    return view('public.home');
});

Route::prefix("admin")->group(function(){
    Route::get('/login',[LoginController::class,"show"])->name("admin.login")->middleware("cekAuth");
    Route::post('/login',[LoginController::class,"login"])->name("admin.login.aksi");
    Route::get("/register",[RegisterController::class,"show"])->name("admin.register");
    Route::get("/dashboard",function(){
        return view("layout.admin");
    })->name("dashboard")->middleware(["auth:admin"]);
    Route::post("/logout",function(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("admin.login");
    })->name("admin.logout");
});
