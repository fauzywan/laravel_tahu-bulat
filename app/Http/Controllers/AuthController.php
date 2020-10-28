<?php

namespace App\Http\Controllers;

use App\Exceptions\Helpers\Toasterku;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {

        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect('/karyawan');
        }
        return redirect('/login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
