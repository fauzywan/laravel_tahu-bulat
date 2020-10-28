<?php

namespace App\Http\Controllers;

use App\Adonan;
use App\Gudang;
use Illuminate\Http\Request;
use App\Biaya_produksi;
use App\Karyawan;
use App\pengaturan_produk;
use App\InfoPerusahaan;
use App\Suplier;

class ApiController extends Controller
{
    public function buka_toko()
    {
        return InfoPerusahaan::latest()->first()->update(['status'=>1]);
    }
    public function tutup_toko()
    {
        return InfoPerusahaan::latest()->first()->update(['status'=>0]);
    }
    public function karyawan(Karyawan $karyawan,$tanggal)
    {
        $tanggal= json_encode($tanggal);
        return ['nama'=>$karyawan->nama,
        'balo'=>$karyawan->balo(),
        'gaji'=>$karyawan->total_gaji($tanggal),
        // 'potongan_gaji'=>$karyawan->potongan($tanggal),
        // 'total_gaji'=>$karyawan->gaji_bersih($tanggal)
    ];

    }

    public function set_harga_sotong($harga)
    {
        if (pengaturan_produk::count() <= 0) {
            $proses = pengaturan_produk::create(['harga' => $harga, 'jumlah' => 0]);
        } else {
            $proses = pengaturan_produk::latest()->first()->update(['harga' => $harga]);
        }
        if ($proses == false) {

            return pengaturan_produk::latest()->first('harga')->harga;
        }
        return $harga;

        // return json_decode(file_get_contents('json/harga_sotong.json'), TRUE);
        // file_put_contents('json/harga_sotong.json', json_encode(['sotong' => $sotong]));
    }
    public function set_jumlah_sotong($jumlah)
    {
        if (pengaturan_produk::count() <= 0) {
            $proses = pengaturan_produk::create(['harga' => $jumlah, 'jumlah' => 0]);
        } else {
            $proses = pengaturan_produk::latest()->first()->update(['jumlah' => $jumlah]);
        }
        if ($proses == false) {
            return pengaturan_produk::latest()->first('jumlah')->jumlah;
        }
        return $jumlah;
    }

    public function bahan_baku($baku, $kuantitas)
    {
        $status = 0;
        if (Adonan::where('biaya_produksi_id', $baku)->count() > 0) {
            Adonan::where('biaya_produksi_id', $baku)->update(['kuantitas' => $kuantitas]);
        } else {
            Adonan::create(['biaya_produksi_id' => $baku, 'kuantitas' => $kuantitas]);
            $status = 1;
        }
        $biaya = Biaya_produksi::find($baku);
        return [
            "status" => $status,
            "bahan" => $biaya->nama,
            "jumlah" =>  Adonan::where('biaya_produksi_id', $baku)->first('kuantitas')->kuantitas . ' ' . $biaya->satuan->nama
        ];
    }
    public function jumlah_baku_gudang($jumlah, $kuantitas)
    {

        $biaya = Biaya_produksi::find($jumlah);
        $biaya->update(['kuantitas' => $kuantitas]);
        $status = 0;
        if ($kuantitas > 0) {
            $status = 1;
        }

        return [
            "status" => $status,
            "bahan" => $biaya->nama,
            "jumlah" => $biaya->kuantitas  . ' ' . $biaya->satuan->nama
        ];
    }
    public function adonan($kuantitas)
    {
        $adonan = Adonan::all();
        return view('menu.api.adonan', compact('kuantitas', 'adonan'));
    }


    public function addBelanja()
    {
        $produksi = Biaya_produksi::all();
        $suplier = Suplier::all();
        return view('menu.belanja._include.add', compact('produksi', 'suplier'));
    }

    public function addBelanja2()
    {
        $produksi = Biaya_produksi::all();
        $suplier = Suplier::all();
        return view('menu.belanja._include.add2', compact('produksi', 'suplier'));
    }
    public function searchProduksi($nama, $jenis)
    {
        if ($jenis == 0) {
            $jenis = "";
        } else {
            $jenis = "AND jenis_biaya_produksi_id = $jenis";
        }

        $data = Biaya_produksi::whereRaw("nama LIKE '%$nama%' $jenis")->get();
        if ($nama == "all") {
            $data = Biaya_produksi::all();
        }


        return view('menu.produksi._include.perBagian', compact('data'));
    }
    public function merkSelect($merk)
    {
        $data = Gudang::where(['produksi_id' => $merk])->get();
        return view('menu.api.merkSelect', compact('data'));
    }
}
