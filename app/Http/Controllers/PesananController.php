<?php

namespace App\Http\Controllers;

use App\Biaya_produksi;
use App\Buat_produk;
use App\Distributor;
use App\Exceptions\Helpers\Toasterku;
use App\InfoPerusahaan;
use App\Karyawan;
use App\Pemakaian;
use App\pengaturan_produk;
use App\Pesanan;
use App\Produk;
use App\sesi;
use App\sesi_produk;
use App\Transaksi_belanja;
use App\Transaksi_pesanan;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PesananController extends Controller
{

    public function index()
    {
        $pesanan = Pesanan::where('status', 1)->orderBy('created_at', 'desc')->get();
        $sedang_dibuat = sesi::all();
        $tanggal = Pesanan::where('status', 1)->distinct('tanggal')->get('tanggal');
        return view('menu.pesanan.index2', compact('pesanan', 'sedang_dibuat', 'tanggal'));
    }
    protected $total = 0;
    protected $belum = 0;
    protected $sudah = 0;
    public function bayar()
    {
        $pesanan = Pesanan::whereRaw('status > 0 AND keuangan > 0')->orderBy('keuangan', 'desc')->get();
        $tanggal = Pesanan::distinct('tanggal')->get('tanggal');

        $this->total =   $pesanan->sum('harga') + $pesanan->sum('biaya_akomodasi');
        $pesanan->map(function ($p) {
            //belum dibayar
            $this->sudah += $p->transaksi_pesanan->sum('nominal_uang');
        });
        $this->belum = $this->total - $this->sudah;
        $total = $this->total;
        $belum = $this->belum;
        $sudah = $this->sudah;

        return view("menu.pesanan.bayars", compact('pesanan', 'tanggal', 'belum', 'sudah', 'total'));
    }
    public function create()
    {
         $toko=InfoPerusahaan::first()->status
;        $distributor = Distributor::all();
        $sotong = pengaturan_produk::first()->harga;
        return view('menu.pesanan.create', compact('distributor', 'sotong','toko'));
    }
    public function buat(Pesanan $pesanan)
    {
        return $pesanan;
    }
    public function store_create(Request $request)
    {
        
        if ($request->pemesan == true) {
            $distributor = Distributor::create(
                [
                'nama' => $request->pemesan, 
                'alamat' => '-',
                'pemilik' => '-',
                'telepon' => 0
                ]);
            if ($distributor == true) {

                $request->nama = Distributor::latest()->first('id')->id;
            }
        }

        $harga = implode('', explode(',', $request->harga));
        $total = implode('', explode(',', $request->total));
        $akomodasi = implode('', explode(',', $request->akomodasi));
        $create =  Pesanan::create([
            'jenis_transaksi_id' => 1,
            'distributor_id' => $request->nama,
            'diterima' => 0,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->kuantitas,
            'harga_satuan' => $harga,
            'biaya_akomodasi' => $akomodasi,
            'harga' => ($total - $akomodasi),
            'status' => 1,
            'keuangan' => 1,
            'potongan_harga' => 0,
            'alamat' => ''
        ]);
        if ($create == true) {
            $pesanan = Pesanan::latest()->first();
        }
        $sesi_create = sesi::create([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->kuantitas,
            'dibuat' => 0,
            'dikemas' => 0,
            'harga' => ($total),
            'balo' => 0,
            'rata_rata' => 0,
            'laba' => 0,
            'status' => 1,
            'inisial' =>  Distributor::find($request->nama)->nama
        ]);
        $pesanan->update(['status' => 2]);
        if ($sesi_create == true) {
            $id = sesi::latest()->first()->id;
            sesi_produk::create(['sesi_id' => $id, 'pesanan_id' => $pesanan->id, 'status' => 1, 'sedang_dibuat' => 0]);
            Toastr::success('Pesanan Berhasil dibuat', '', Toasterku::config());
            return redirect("/pesanan/store/$pesanan->id/transaksi");
        } else {
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {

        if ($request->pemesan == true) {
            $distributor = Distributor::create(['nama' => $request->pemesan, 'alamat' => '-', 'pemilik' => '-', 'telepon' => 0]);
            if ($distributor == true) {

                $request->nama = Distributor::latest()->first('id')->id;
            }
        }
        $harga = implode('', explode(',', $request->harga));
        $total = implode('', explode(',', $request->total));
        $akomodasi = implode('', explode(',', $request->akomodasi));
        $create =  Pesanan::create([
            'jenis_transaksi_id' => 1,
            'distributor_id' => $request->nama,
            'diterima'=>0,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->kuantitas,
            'harga_satuan' => $harga,
            'biaya_akomodasi' => $akomodasi,
            'harga' => ($total - $akomodasi),
            'status' => 1,
            'keuangan' => 1,
            'potongan_harga' => 0,
            'alamat'=>''
        ]);
        if ($create == true) {
            $id = Pesanan::latest()->first()->id;
        }
        Toastr::success('Pesanan Berhasil dibuat', '', Toasterku::config());
        return redirect("/pesanan/store/$id/transaksi");
    }

    public function edit(Pesanan $pesanan)
    {
        $distributor = Distributor::all();
        return view('menu.pesanan.edit', compact('distributor', 'pesanan'));
    }
    public function update(Pesanan $pesanan, Request $request)
    {
        $distributor = Distributor::all();
        return view('menu.pesanan.edit', compact('distributor', 'pesanan'));
    }

    public function delete(Pesanan $pesanan)
    {
        $pesanan->delete();
        return redirect()->ebback();
    }

    public function w()
    {
        return view('menu.pesanan.transaksi');
    }
    public function buat_produk()
    {
        $pesanan = Pesanan::where('status', 1)->get();

        return view('menu.pesanan.buat', compact('pesanan'));
    }

    public function buat_produk_store()
    {
    }
    public function profil(Pesanan $pesanan)
    {
        return view('menu.pesanan.profil', compact('pesanan'));
    }
    public function laporan()
    {
         $tanggal = date('Y-m-d');
         $jumlah         = pengaturan_produk::latest()->first()->jumlah;
         $pesanan        = Pesanan::where('tanggal',$tanggal)->get();
         $total_harga    = 0;
         $uang_masuk     = 0;
         $belum_dibayar  = 0;

        for ($i=0; $i < count($pesanan) ; $i++) { 
            $total_harga+= $pesanan[$i]->total_harga();
            $uang_masuk+= $pesanan[$i]->total_harga()-$pesanan[$i]->belumDibayar();
            $belum_dibayar+= $pesanan[$i]->belumDibayar();
        }
        $uang['masuk']=$uang_masuk;
        $uang['total']=$total_harga;
        $uang['diluar']= $belum_dibayar;
        $uang['pemakaian']= Pemakaian::where('tanggal',$tanggal)->sum('harga');
        $uang['baloan'] = round($pesanan->sum('jumlah')/$jumlah);
        if($uang['baloan']==0){

            $uang['rata_rata']= 0;
        }else{

             $uang['rata_rata']= round($pesanan->sum('jumlah') / $uang['baloan']) ;
        }

        return view('menu.pesanan.laporan', compact('pesanan','jumlah','tanggal', 'uang'));
    }

    /*
    public function form(Pesanan  $pesanan, $id)
    {
        $karyawan = Karyawan::all();
        return view("menu.pesanan.form", compact('id', 'pesanan', 'karyawan'));
    }

    public function form_store(Pesanan  $pesanan, $id, Request $request)
    {

        $create = Buat_produk::create([
            'pesanan_id' => $pesanan->id,
            'karyawan_1' => $request->karyawan_1,
            'karyawan_2' => $request->karyawan_2,
            'jumlah_1' => 0,
            'jumlah_2' => 0,
            'gaji_1' => 0,
            'gaji_2' => 0,
            'posisi_id' => $id

        ]);

        if ($id == 1) {
            $pesanan->update(['status' => 2]);

            // return redirect("");
        } else {
            $pesanan->update(['status' => 4]);
        }

        return redirect('/pesanan');
    }

    public function buat_detail(Buat_produk $buat_produk)
    {

        $produk = $buat_produk;
        $produksi = Biaya_produksi::all();

        return view('menu.pesanan.buat_detail', compact('produk', 'produksi'));
    }
    public function packing_detail(Buat_produk $buat_produk)
    {
        $produk = $buat_produk;
        $produksi = Biaya_produksi::all();

        return view('menu.pesanan.packing_detail', compact('produk', 'produksi'));
    }

*/

    // public function
    public function ambil(Pesanan $pesanan)
    {
        return $pesanan;
        $pesanan->update(['status' => 0]);
        return redirect()->back();
    }



}
