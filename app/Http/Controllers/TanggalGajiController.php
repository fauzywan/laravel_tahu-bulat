<?php

namespace App\Http\Controllers;

use App\Tanggal_gaji;
use Illuminate\Http\Request;

class TanggalGajiController extends Controller
{
    public function store(Request $request)
    {
        Tanggal_gaji::create(['tanggal' => $request->tanggal, 'status' => 1]);
        return redirect()->back();
    }
    public function update(Request $request, Tanggal_gaji $tanggal_gaji)
    {
        $tanggal_gaji->update(['tanggal' => $request->tanggal]);
        return redirect()->back();
    }
}
