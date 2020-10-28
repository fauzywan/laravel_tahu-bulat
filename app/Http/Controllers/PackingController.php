<?php

namespace App\Http\Controllers;
use App\Sesi;
use App\sesi_karyawan;
use App\Buat_produk;
use App\absen;

use Illuminate\Http\Request;

class PackingController extends Controller
{
    
        public function index (sesi $sesi,Request $request)
    {
     $absen=absen::where('tanggal',date('Y-m-d'))->get();
$karyawan=sesi_karyawan::distinct('karyawan_id')->where('sesi_id',$sesi->id)->get('karyawan_id');
$karyawan=$karyawan->filter(function($sk){
return  $sk->karyawan->posisi_id==2;

});

     return view('menu.sesi.packing',compact('sesi','karyawan','absen'));
    }
    public function store(Sesi $sesi,Request $request)
    {
     
        $sesi->update(['dikemas'=>array_sum($request->jumlah)]);
       $create= Buat_produk::create([
            'sesi_produk_id'=>0,
            'sesi_id'=>$sesi->id,
            'balo'=>0,
            'gaji'=>0,
            'status'=>0,
            'jumlah'=>array_sum($request->jumlah),
            'jenis'=>2
        ]);

        if($create==true)
        {
            $create=Buat_produk::latest()->first();
            for ($i = 0; $i < count($request->karyawan); $i++) {

                    sesi_karyawan::create(['sesi_id'=>$sesi->id,'buat_produk_id'=>$create->id,
                    'karyawan_id'=>$request->karyawan[$i],
                    'dibuat'=>$request->jumlah[$i],
                    'status'=>0,
                    'jenis'=>0]);

            }
        }

        return redirect()->back();
            
    }

}
