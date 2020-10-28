<?php

namespace App\Http\Controllers;

use App\pengaturan_produk;
use App\pengaturan_tanggal;
use App\Pesanan;
use App\Transaksi_pesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $total_harga=0;
    public function index()
    {
        $tanggal=pengaturan_tanggal::latest()->first();
        $tanggal=(object)['mulai'=>1,'tutup'=>1];
        if($tanggal==null)
        {
            $tanggal->mulai=date('Y-m-d');
            $tanggal->selesai=date('Y-m-d',strtotime('+1 year'));
        }
$data['pesanan_hari_ini']=Pesanan::where('tanggal',date('Y-m-d'))->count();
$data['pesanan']=Pesanan::where('tanggal','>=',$tanggal->mulai)->where('tanggal','<=',$tanggal->tutup)->count();
$data['jumlah']=Pesanan::where('tanggal','>=',$tanggal->mulai)->where('tanggal','<=',$tanggal->tutup)->sum('jumlah');
Pesanan::where('tanggal','>=',$tanggal->mulai)->where('tanggal','<=',$tanggal->tutup)->get()-> map(function($p){
$this->total_harga+=$p->total_harga();
});
$data['uang_masuk']=
$data['uang_diluar']=number_format(Transaksi_pesanan::where('created_at','>=',$tanggal->mulai)->where('created_at','<=',$tanggal->tutup)->sum('nominal_uang')- $this->total_harga);
$data['uang_masuk']
        = number_format(Transaksi_pesanan::where('created_at', '>=', $tanggal->mulai)->where('created_at', '<=', $tanggal->tutup)->sum('nominal_uang'));
        $data['total_harga'] = number_format($this->total_harga);
        return view('menu.dashboard.index',compact('data'));
        

    }
}
