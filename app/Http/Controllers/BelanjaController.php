<?php

namespace App\Http\Controllers;

use App\Gudang;
use App\Belanja;
use App\Suplier;
use App\Sisa_gudang;
use App\Biaya_produksi;
use App\Daftar_belanja;
use App\Tanggal_belanja;
use App\Transaksi_belanja;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Exceptions\Helpers\Toasterku;
use Illuminate\Support\Facades\DB;

class BelanjaController extends Controller
{
    public function index()
    {
        $produksi = Biaya_produksi::all();
        $suplier = Suplier::all();
        // $tanggal = Tanggal_belanja::latest()->first();
        return view('menu.belanja.index', compact('produksi', 'suplier'));
    }


    public function histori()

    {
        $tanggal = Belanja::distinct('created_at')->where('kuantitas',">",0)->orderBy('created_at', 'desc')->get('created_at');

        return view('menu.belanja.histori2', compact('tanggal'));
    }
 
    public function filter(Request $request)
    {
        if ($request->mulai != null) {
            $where[] = "created_at >= '$request->mulai'";
        }
        if ($request->sampai != null) {
            $where[] = "created_at <= '$request->sampai'";
        }

        $where = implode(' && ', $where);
        $tanggal = Belanja::distinct('created_at')->whereRaw($where)->orderBy('created_at', 'desc')->get('created_at');

        $mulai = $request->mulai;
        $sampai = $request->sampai;
        return view('menu.belanja.filter', compact('tanggal', 'mulai', 'sampai'));
    }
    public function histori2()
    {
        $tanggal = Belanja::distinct('created_at')->orderBy('created_at', 'desc')->get('created_at');

        return view('menu.belanja.histori2', compact('tanggal'));
    }
    protected $jumlah_hutang;
    public function hutang()
    {

        $hutang = Belanja::where('hutang', 1)->get();
        $tanggal = Belanja::distinct('created_at')->where('hutang', 1)->get('created_at');
        $jumlah_hutang = $hutang->map(function ($hutang) {
            $this->jumlah_hutang += ($hutang->harga - $hutang->transaksi_belanja->sum('nominal_uang'));
        });
        $jumlah_hutang = $this->jumlah_hutang;

        return view('menu.belanja.hutang', compact('hutang', 'tanggal', 'jumlah_hutang'));
    }
    public function hutang_transaksi(Request $request)
    {
        $request->validate(['hutang' => 'required']);
        for ($i = 0; $i < count($request->hutang); $i++) {
            $uang = implode('', explode(',', $request->uang[$i]));
            $belanja = Belanja::find($request->hutang[$i]);
            if ($belanja->Transaksi_belanja->sum('nominal_uang') + $uang <= $belanja->harga) {
                $belanja->Transaksi_belanja;

                if ($belanja->Transaksi_belanja->sum('nominal_uang') + $uang == $belanja->harga) {
                    $belanja->update(['hutang' => 0]);
                }
                Transaksi_belanja::create([
                    'nominal_uang' => $uang,
                    'jenis_transaksi_id' => 1,
                    'tanggal' => $request->tanggal,
                    'belanja_id' => $request->hutang[$i]
                ]);
            }
            if ($belanja->harga == $belanja->transaksi_belanja->sum('nominal_uang')) {
                $belanja->update(['hutang' => 0]);
            }
        }
        return redirect()->back();
    }
    public function respon()
    {

        $produksi = Biaya_produksi::all();
        $suplier = Suplier::all('nama');
        $belanja = Daftar_belanja::where('status', 1)->get();
        return view('menu.belanja.respon', compact('belanja', 'produksi', 'suplier'));
    }
    public function store(Request $request)
    {
        if($request->faktur[0]==null){
            Toastr::success('Nomor Fatur Belum Diisi', '', Toasterku::config());

            return redirect()->back();

        }

        for ($i = 0; $i < count($request->barang); $i++) {
            $dibayar = implode('', explode(',', $request->dibayar[$i]));
            $harga = implode('', explode(',', $request->harga[$i]));
            $total = implode('', explode(',', $request->total[$i]));
            $status = 1;
            $hutang = 0;
            if ($dibayar < $total) {
                $hutang = 1;
            }
            Belanja::create([
                'suplier_id' => $request->suplier[0],
                'biaya_produksi_id' => $request->barang[$i],
                'hutang' => $hutang,
                'nomor_faktur' => $request->faktur[0],
                'harga' => $total,
                'harga_satuan' => $harga,
                'kuantitas' => $request->kuantitas[$i],
                'tersedia' => $request->kuantitas[$i],
                'status' => $status,
                'created_at' =>  $request->tanggal,
                // 'penanggung_jawab' => $request->tanggung_jawab,

            ]);
            $belanja = Belanja::where([
                'biaya_produksi_id' => $request->barang[$i],
                'nomor_faktur' =>
                $request->faktur[0]
            ])->latest('id')->first('id')->id;
            Transaksi_belanja::create([
                'tanggal' => $request->tanggal,
                'nominal_uang' => $dibayar,
                'belanja_id' => $belanja,
                'jenis_transaksi_id' => 1,

            ]);
        }
        Toastr::success('Pembelanjaan Berhasil', '', Toasterku::config());

        return redirect()->back();
    }
}
