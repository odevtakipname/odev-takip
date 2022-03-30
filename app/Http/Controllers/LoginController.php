<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request){
        if (Auth::attempt(['eposta'=>$request->email,'password'=>$request->password])) {
            return redirect('takip/');
        }
        return redirect('/')->withErrors('Email ve şifreniz hatalı düzeltip tekrar deneyiniz !');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
