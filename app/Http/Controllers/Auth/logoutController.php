<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Helpers\Toasterku;
use App\Helpers\MyToastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout()
    {
        auth()->logout();
        Toastr::success('Anda Berhasil Logout.', '', Toasterku::config());
        return redirect()->route('login');
    }
}
