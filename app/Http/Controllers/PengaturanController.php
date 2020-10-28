<?php

namespace App\Http\Controllers;

use App\Adonan;
use App\Biaya_produksi;
use App\Exceptions\Helpers\Toasterku;
use App\InfoPerusahaan;
use App\pengaturan_produk;
use App\pengaturan_tanggal;
use App\Tanggal_gaji;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use SebastianBergmann\Type\ObjectType;

class PengaturanController extends Controller
{
    public function index()
    {
        
        pengaturan_produk::count() > 0 ? $produk = pengaturan_produk::latest()->first() : $produk = (object) (["harga" => 0, 'jumlah' => 0]);
        $gaji                                    = Tanggal_gaji::latest()->first();
        $biaya_produksi                          = Biaya_produksi::all();
        $adonan                                  = Adonan::all();
        $profil                                  = InfoPerusahaan::latest()->first('status');
        $pengaturan_tanggal                      = pengaturan_tanggal::latest()->first();
        return view('menu.pengaturan.index', compact('biaya_produksi', 'adonan', 'produk', 'gaji','profil', 'pengaturan_tanggal'));
        
        // return view('menu.pengaturan.bahan_baku_js', compact('biaya_produksi', 'adonan', 'produk'));
 }

    public function produk()
    {
        $jumlah_baku = json_decode(file_get_contents('json/baku.json', TRUE));
        $biaya_produksi = Biaya_produksi::all();
        $gaji = Tanggal_gaji::latest()->first();
        $harga_satuan = json_decode(file_get_contents('json/harga_sotong.json'), TRUE)['sotong'];
        return view('menu.pengaturan.index', compact('gaji', 'biaya_produksi', 'jumlah_baku', 'harga_satuan'));
   
    }
    public function jadwal()
    {
        $jumlah_baku = json_decode(file_get_contents('json/baku.json', TRUE));
        $biaya_produksi = Biaya_produksi::all();
        $gaji = Tanggal_gaji::latest()->first();
        $harga_satuan = json_decode(file_get_contents('json/harga_sotong.json'), TRUE)['sotong'];
        return view('menu.pengaturan.date', compact('gaji', 'biaya_produksi', 'jumlah_baku', 'harga_satuan'));
    }
    public function gaji_store(Request $request)
    {
        Tanggal_gaji::create(['tanggal' => $request->tanggal, 'status' => 1]);
        Toastr::success('Pengaturan Berhasil', '', Toasterku::config());

        return redirect()->back();
    }
    public function gaji_update(Request $request, Tanggal_gaji $tanggal_gaji)
    {
        $tanggal_gaji->update(['tanggal' => $request->tanggal]);
        Toastr::success('Pengaturan Berhasil', '', Toasterku::config());

        return redirect()->back();
    }
    public function bahan_baku(Request $request)
    {
        if (Adonan::where('biaya_produksi_id', $request->bahan)->count() > 0) {
            Adonan::where('biaya_produksi_id', $request->bahan)->update(['kuantitas' => $request->kuantitas]);
        } else {
            Adonan::create([
                'biaya_produksi_id' => $request->bahan,
                'kuantitas' => $request->kuantitas
            ]);
        }
        Toastr::success('Pengaturan Berhasil', '', Toasterku::config());
        return redirect()->back();
    }
    public function minimal_pemakaian(Request $request)
    {
        Biaya_produksi::find($request->bahan)->update(['minimal_pemakaian' => $request->kuantitas]);
        Toastr::success('Pengaturan Berhasil', '', Toasterku::config());

        return redirect()->back();
    }
    public function jumlah_produk(Request $request)
    {

        if (pengaturan_produk::count() > 0) {
            pengaturan_produk::latest()->first()->update(['jumlah' => $request->jumlah]);
        } else {
            pengaturan_produk::create(['jumlah' => $request->jumlah, 'harga' => 0]);
        };
        Toastr::success('Pengaturan Berhasil', '', Toasterku::config());
        return redirect()->back();
    }

    public function harga_produk(Request $request)
    {

        if (pengaturan_produk::count() > 0) {
            pengaturan_produk::latest()->first()->update(['harga' => $request->harga]);
        } else {
            pengaturan_produk::create(['harga' => $request->harga, 'jumlah' => 0]);
        };
        Toastr::success('Pengaturan Berhasil', '', Toasterku::config());
        return redirect()->back();
    }
    public function profile()
    {
         $profil=InfoPerusahaan::latest()->first();
         if($profil==null){
             $create=InfoPerusahaan::create(
                 ['nama'=>'Perusahaan','
                 alamat'=>'Alamat',
                 'uang'=>0,
                 'telepon'=>'082130433253',
                 'email'=>'iwanfauzy346@gmail.com',
                 'moto'=>'Sen no michi mo ippo kara',
                 'pemilik'=>'pemilik',
                 'status'=>0
                 ]);
             if($create===true){
                 $profil=InfoPerusahaan::latest()->first();
             }
         }
        return view('menu.pengaturan.perusahaan',compact('profil'));
    }
    public function profile_post(Request $request)
    {
        InfoPerusahaan::latest()->first()->update([
            'nama'=>$request->nama,
            'pemilik'=>$request->pemilik,
            'alamat'=>$request->alamat,
            'moto'=>$request->moto,
            'telepon'=>$request->telepon,
            'email'=>$request->email,
            ]);
            Toastr::success('Berhasil','',Toasterku::config());
            return redirect()->back();
        
    }
    public function mulai(Request $request)
    {

        if(InfoPerusahaan::count()==null)
        {
            InfoPerusahaan::create([
            'nama'=>'Putra Shongka',
            'alamat'=>'',
            'pemilik'=>'',
            'telepon'=>'',
            'email'=>'',
            'moto'=>'',
            'uang'=>0,
            'status'=>1
            ]);

        }
         InfoPerusahaan::latest()->first()->update(['status'=>1]);
        pengaturan_tanggal::create(['mulai'=>$request->mulai,'tutup'=>$request->selesai]);
        Tanggal_gaji::create(['tanggal'=>$request->selesai,'status'=>1]);
        return redirect()->back();
    }
    public function selesai(pengaturan_tanggal $pengaturan_tanggal,Request $request)
    {
        
          InfoPerusahaan::latest()->first()->update(['status'=>1]);
          $mulai
        = $request->mulai;
        
        $tutup= $request->tutup;
          pengaturan_tanggal::create(['mulai'=>$mulai,'tutup'=>$tutup]);
         return redirect()->back();
    }
}

