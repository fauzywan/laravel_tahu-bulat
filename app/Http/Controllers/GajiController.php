<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\pengaturan_tanggal;
use App\sesi_karyawan;
use App\Tanggal_gaji;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
 $tanggal=Tanggal_gaji::where(['status'=>1])->first('tanggal')->tanggal;
         $tanggal =  pengaturan_tanggal::where(['tutup'=>$tanggal])->first(); 
 $karyawan = (Karyawan::all());
        
        return view('menu.gaji.index', compact('karyawan','tanggal'));
    }
}
