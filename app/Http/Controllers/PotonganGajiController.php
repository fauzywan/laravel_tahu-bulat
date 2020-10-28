<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\pengaturan_tanggal;
use App\Potongan_gaji;
use Illuminate\Http\Request;

class PotonganGajiController extends Controller
{
    public function index()
    {
        $karyawan=Karyawan::all();
        return view('menu.gaji.potongan.index',compact('karyawan'));
    }
    public function show(Request $request)
    {
       $tanggal= pengaturan_tanggal::latest()->first();
        $karyawan=Potongan_gaji::where('created_at','>=',$tanggal->mulai)->where('created_at','<=',$tanggal->tutup)->get();
        return view('menu.gaji.potongan.show',compact('karyawan'));
    }
    public function store(Request $request)
    {
        $uang=implode('',explode(',',$request->uang));
        Potongan_gaji::create([
            'karyawan_id'=>$request->karyawan,
            'nominal_uang'=>$uang
        , 'keterangan'=>$request->deskripsi,
        'tanggal'=>$request->tanggal]);
        return redirect()->back();
    }
}
