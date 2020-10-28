<?php

namespace App\Http\Controllers;

use App\absen;
use App\sesi;
use App\Adonan;
use App\Gudang;
use App\Belanja;
use App\Biaya_produksi;
use App\Pesanan;
use App\Karyawan;
use App\Pemakaian;
use App\Buat_produk;
use App\pengaturan_produk;
use App\sesi_karyawan;
use App\sesi_produk;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    protected $pemakaian;
    protected $bahan;
    protected $nama;
    protected $harga;
    protected $kuantitas;
    public function index(Sesi $sesi)
    {
$this->pemakaian=[];
        $karyawan = sesi_karyawan::distinct('karyawan_id')->where('sesi_id', $sesi->id)->get();
         $pemakaian = Pemakaian::where(['sesi_id'=>$sesi->id])->get();
$pemakaian->map(function($p){

    $this->nama=$p->belanja->biaya_produksi_id;
    
    $this->harga=$p->belanja->harga_satuan;

    if(!isset($this->pemakaian[$this->nama])){

        $this->bahan[]=$p->belanja;

        $this->pemakaian[$this->nama]=[];
    }
    if(!isset($this->pemakaian[$this->nama][$this->harga])){

        $this->pemakaian[$this->nama][$this->harga]=["nama"=>$p->belanja->biaya_produksi->nama,'harga'=>$this->harga];

    }
   
      $this->kuantitas[$this->nama."_".$this->harga]['jumlah'][]=$p->jumlah;
      $this->kuantitas[$this->nama."_".$this->harga]['harga'][]=$p->harga;
});
$pemakaian= $this->pemakaian;
$bahan= $this->bahan;
$kuantitas= $this->kuantitas;
        return view('menu.sesi.index', compact('sesi', 'karyawan','pemakaian','bahan','kuantitas'));
        // return view('menu.sesi.index2', compact('sesi', 'karyawan', 'pesanan', 'belanja', 'pemakaian'));
    }

    public function adonan(Sesi $sesi)
    {
        $adonan = Buat_produk::where('sesi_id', $sesi->id)->get();
        $jumlah_balo = pengaturan_produk::latest()->first();
        return view('menu.sesi.adonan', compact('sesi', 'adonan', 'jumlah_balo'));
    }
    public function buat_adonan(Sesi $sesi)
    {
        $adonan = Adonan::all();
        $karyawan = absen::where(['tanggal' => date('Y-m-d')])->get();
        return view('menu.sesi.create', compact('adonan', 'karyawan', 'sesi'));
    }
    public function karyawan(Sesi $sesi)
    {
        return view('menu.sesi.karyawan');
    }
    public function delete(sesi $sesi)
    {
        $sesi->delete();
        return redirect('/pesanan');
    }
    
    public function ambil_bahan(Sesi $sesi, Request $request)
    {
        $this->kuantitas = 0;
        $sesi_karyawan = sesi_karyawan::where(['sesi_id' => $sesi->id, 'karyawan_id' => $request->karyawan])->first();
        $sesi_karyawan->update(['status' => 2]);
        Buat_produk::create([
            'jumlah' => 0,
            'balo' => $request->adonan,
            'gaji' => 0,
            'status' => 1,
            'jenis'=>1
        ]);

        for ($i = 0; $i < count($request->bahan); $i++) {
            $this->kuantitas = $request->kuantitas[$i];
            $belanja =  Belanja::where(['status' => 1, 'gudang_id' => Gudang::where('biaya_produksi_id', $request->bahan[$i])->first()->id])->orderBy('created_at', 'asc')->get();
            foreach ($belanja as $key) {
                if ($this->kuantitas != 0) {

                    if ($key->tersedia - $this->kuantitas <= 0) {
                        $pemakian = $key->tersedia;
                        $key->update(['tersedia' => 0, 'status' => 0]);
                    } else {
                        $pemakian = $key->tersedia - ($key->tersedia - $this->kuantitas);
                        $key->update(['tersedia' => $key->tersedia - $this->kuantitas]);
                        $this->kuantitas = 0;
                    }
                    Pemakaian::create(['sesi_id' => $sesi->id, 'karyawan_id' => $request->karyawan, 'jumlah' => $pemakian, 'tanggal' => $request->tanggal, 'belanja_id' => $key->id]);
                }
            }
        }
        return redirect()->back();
    }

    public function pesanan_delete(sesi_produk $sesi_produk, sesi $sesi)
    {
        $sesi->update([
            'jumlah' => ($sesi->jumlah - $sesi_produk->pesanan->jumlah),
            'harga' => ($sesi->harga - $sesi_produk->pesanan->harga)
        ]);
        $sesi_produk->delete();
        return redirect()->back();
    }
    public function create(Request $request)
    {
        $inisial = $request->init;
        $harga = 0;
        $nama = [];
        for ($j = 0; $j < count($request->jumlah); $j++) {
            $pesanan = Pesanan::find($request->pesanan[$j]);
            $harga += ($pesanan->total_harga());
            $nama[] = $pesanan->distributor->nama;
        }
        $nama = implode(',', $nama);
        if ($request->init == "") {
            $inisial = $nama;
        }

        $create = sesi::create([
            'tanggal' => $request->tanggal,
            'jumlah' => array_sum($request->jumlah),
            'dibuat' => 0,
            'dikemas' => 0,
            'harga' => $harga,
            'balo' => 0, 'rata_rata' => 0,
            'laba' => 0,
            'status' => 1,
            'inisial' => $inisial
        ]);
        if ($create == true) {

            $id = sesi::latest()->first()->id;


            for ($i = 0; $i < count($request->jumlah); $i++) {

                sesi_produk::create([
                    'pesanan_id' => $request->pesanan[$i], 'sesi_id' => $id, 'status' => 1, 'sedang_dibuat' => 0
                ]);
                Pesanan::find($request->pesanan[$i])->update(['status' => 2]);
            }
            return redirect("/pesanan/$id/sesi")->with(['pesan' => 'Pesanan mulai dibuat', 'alert' => 'success']);
        }
    }

    public function selesai(Sesi $sesi)
    {

            $sesi->update([
                'status' => 0,
            'rata_rata'=>$sesi->rata_rata(),
            'laba'=>$sesi->laba()]);
        return redirect("/pesanan/$sesi->id/rekap");
    }

    public function produk(sesi $sesi, Request $request)
    {
        $karyawan = $sesi->sesi_karyawan->where('karyawan_id', $request->karyawan)->first();
        Buat_produk::where(['status' => 1, 'sesi_karyawan_id' => $karyawan->id])->first()->update();
        return redirect()->back();
    }
    public function serahkan(sesi $sesi,Request $request, Pesanan $pesanan)
    {
        $pesanan= sesi_produk::where(['sesi_id'=>$sesi->id,'pesanan_id'=>$pesanan->id])->first();
        $pesanan->update(['status'=>0]);
        $pesanan->pesanan->update(['diterima' => $pesanan->diterima + $request->jumlah,'status'=>0]);
        return redirect()->back();
    }

    public function rekap(Sesi $sesi)
    {

        return view('menu.sesi.rekap', compact('sesi'));
    }
}



