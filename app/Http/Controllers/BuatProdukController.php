<?php

namespace App\Http\Controllers;

use App\Adonan;
use App\Biaya_produksi;
use App\Buat_produk;
use App\Distributor;
use App\Exceptions\Helpers\Toasterku;
use App\Karyawan;
use App\Belanja;
use App\InfoPerusahaan;
use App\Pemakaian;
use App\pengaturan_produk;
use App\Pesanan;
use App\sesi;
use App\sesi_karyawan;
use App\sesi_produk;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BuatProdukController extends Controller
{
    public function index(Pesanan $pesanan)
    {
        if ($pesanan->status == 1) {
            $karyawan = Karyawan::all();
            return view('menu.buat_pesanan.pesanan', compact('pesanan', 'karyawan'));
        }

        if ($pesanan->status == 2 || $pesanan->status == 3) {
            $url = $pesanan->buat_produk->where('posisi_id', 1)->first()->id;
            return redirect("buat/$url/detail");
        } else {
            return redirect("/pesanan/$pesanan->id/detail");
        }
    }

    public function store(sesi $sesi, Request $request)
    {
        if (Buat_produk::where('karyawan_id', $request->karyawan)->count() > 0) {
            return redirect()->back()->with(['pesan' => 'Karyawan Sudah Ditambahkan', 'alert' => 'danger']);
        }

        Buat_produk::create(['karyawan_id' => $request->karyawan, 'sesi_id' => $sesi->id, 'jumlah' => 0, 'balo' => 0, 'gaji' => 0]);
        return redirect()->back()->with(['pesan' => 'Karyawan Berhasil ditambahkan', 'alert' => 'success']);
    }
    // public function store(Request $request)
    // {

    //     Pesanan::where('id', $request->nama)->update(['status' => 2]);
    //     Buat_produk::create([
    //         'pesanan_id' => $request->nama,
    //         'karyawan_1' => $request->karyawan_1,
    //         'karyawan_2' => $request->karyawan_2,
    //         'jumlah_1' => 0,
    //         'jumlah_2' => 0,
    //         'gaji_1' => 0,
    //         'gaji_2' => 0,
    //     ]);
    //     return redirect()->back();
    // }
    public function edit(Buat_Produk $buat_produk)
    {
        $karyawan = Karyawan::all();
        $distributor = Distributor::all();
        $pesanan = $buat_produk->pesanan;
        return view('menu.buat_pesanan.edit', compact('buat_produk', 'karyawan', 'distributor'));
    }
    // public function update(Request $request, Buat_produk $buat_produk)
    // {
    //     if ($buat_produk->pesanan) {
    //     }
    //     return $request;
    //     $buat_produk->update(['karyawan_1' => $request->karawan_1, 'karyawan_2' => $request->karayawan_2]);
    // }

    public function selesai(Buat_produk $buat_produk)
    {
        $produk = $buat_produk;
        $produksi = Biaya_produksi::all();

        return view('menu.buat_pesanan.selesai', compact('produk', 'produksi'));
    }
    public function sukses(Buat_produk $buat_produk, Request $request)
    {
        $buat_produk->pesanan->update(['status' => 3]);
        $buat_produk->update([
            'jumlah_1' => $request->jumlah_1,
            'jumlah_2' => $request->jumlah_2,
            'gaji_1' => $request->gaji_1,
            'gaji_2' => $request->gaji_2,
        ]);
        return redirect('/pesanan');
    }

    public function ambil_bahan(Request $request, Buat_produk $buat_produk)
    {
        for ($i = 0; $i < count($request->bahan); $i++) {
            $belanja = Belanja::find($request->bahan[$i]);
            Pemakaian::create([
                'buat_produk_id' => $buat_produk->id,
                'sesi_id' => $buat_produk->sesi->id,
                'karyawan_id' => $buat_produk->karyawan->id,
                'belanja_id' => $belanja->id,
                'jumlah' => $request->kuantitas[$i],
                'harga' => $request->kuantitas[$i] * $belanja->harga_satuan,
                'tanggal' => now()
            ]);
        }
        return redirect()->back();
    }
    public function detail(Buat_produk $buat_produk)
    {
        $jumlah = pengaturan_produk::first('jumlah')->jumlah;
        $karyawan = Karyawan::all();
        $bahan = Belanja::whereRaw("status = 1 AND  tersedia > 0")->get();
        $sesi=$buat_produk->sesi;
        return view('menu.sesi.buat_produk', compact('buat_produk', 'karyawan', 'bahan', 'jumlah','sesi'));
    }
    public function karyawan(Request $request, Buat_produk $buat_produk)
    {
        for ($i = 0; $i < count($request->rekan); $i++) {
            sesi_karyawan::create([
                'karyawan_id' => $request->rekan[$i],
                'sesi_id' => $buat_produk->sesi_id,
                // 'sesi_produk_id' => $buat_produk->sesi_produk_id,
                'buat_produk_id' => $buat_produk->id,
                'status' => 1,
                'dibuat' => 0
            ]);
        }
        Toastr::success('Berhasil', '', Toasterku::config());
        return redirect()->back();
    }
    public function rekap(Request $request, Buat_produk $buat_produk)
    {
        for ($i = 0; $i < count($request->karyawan); $i++) {

            sesi_karyawan::find($request->karyawan[$i])->update(['status' => 0, 'dibuat' => $request->jumlah[$i]]);
        }


        $buat_produk->update(['jumlah' => $buat_produk->jumlah + array_sum($request->jumlah), 'status' => 0]); //Buat Produk    
        $sesi = sesi::find($buat_produk->sesi->id);
        $dibuat = $sesi->buat_produk->where(['sesi_id' => $sesi->id])->sum('jumlah');
        $balo = $sesi->buat_produk->where(['sesi_id' => $sesi->id])->sum('balo');
        $sesi->update(['dibuat' => $buat_produk->jumlah, 'balo' => $balo]);
        return redirect()->back();
    }
}
