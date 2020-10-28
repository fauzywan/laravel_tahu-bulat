<?php

namespace App\Http\Controllers;

use App\Gudang;
use App\Satuan;
use App\Biaya_produksi;
use App\Exceptions\Helpers\Toasterku;
use App\Tanggal_belanja;
use Brian2694\Toastr\Facades\Toastr;
// use App\Sisa_gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GudangController extends Controller
{
    public function index()

    {
        $produksi = Biaya_produksi::where('gudang', 0)->where('jenis_biaya_produksi_id',1)->orderBy('nama')->get();
        $gudang = Biaya_produksi::where('gudang', 1)->orderBy('nama')->get();

        $satuan = Satuan::all();
        return view('menu.gudang.index', compact('gudang', 'produksi', 'satuan'));
    }
    public function store(Request $request)
    {
        $request->validate(['produksi' => 'required|unique:gudang,biaya_produksi_id']);
        Biaya_produksi::find($request->produksi)->update(['gudang' => 1]);
        Toastr::success('Berhasil dimasukan Kedaftar Gudang', '', Toasterku::config());
        return redirect()->back();
    }
    public function detail(Biaya_produksi $biaya_produksi)
    {

        $gudang = $biaya_produksi;
        return view('menu.gudang.detail', compact('gudang'));
    }
    // public function store(Request $request)
    // {
    //     if (Tanggal_belanja::where('tanggal', $request->tanggal)->get()->count() == 0) {
    //         Tanggal_belanja::create(['id']);
    //     }
    //     return $request;

    //     $request->validate(['barang' => 'required', 'tanggal' => 'required']);
    //     if ($request->harga == null) {
    //         $request->harga = 0;
    //     }
    //     if ($request->total == null) {
    //         $request->total = 0;
    //     }

    //     // menghilangkan koma(_Menjadi Array_)
    //     $request->harga = explode(',', $request->harga);
    //     $request->total = explode(',', $request->total);
    //     //Menggabungkan array(_Membentuk Angka_)
    //     $request->harga  = implode("", $request->harga);
    //     $request->total = implode("", $request->total);

    //     $create =  Gudang::create([
    //         'biaya_produksi_id' => $request->barang,
    //     ]);
    //     $pesan = ['pesan' => 'Penyimpanan Barang Berhasil', 'alert' => 'success'];
    //     if ($create == false) {
    //         $pesan = ['pesan' => 'Penyimpanan Barang Gagal', 'alert' => 'danger'];
    //     }
    //     return redirect()->back()->with($pesan);
    // }
}
