<?php

namespace App\Http\Controllers;

use App\Gudang;
use App\Jenis_biaya_produksi;
use App\Belanja;
use App\Biaya_produksi;
use App\Satuan;
use Illuminate\Http\Request;

class BiayaProduksiController extends Controller
{
    public function index()
    {

        $satuan = Satuan::all();
        $produksi = Biaya_produksi::all();
        $jenis = Jenis_biaya_produksi::all();
        return view('menu.produksi.index', compact('satuan', 'produksi', 'jenis'));
    }
    public function store(Request $request)
    {

        $request->validate(['nama' => 'required', 'jenis' => 'required']);
        if ($request->jenis == 1) {
            if (Jenis_biaya_produksi::find(1) == false) {
                Jenis_biaya_produksi::create(['id' => 1, 'nama' => 'Bahan Baku']);
            }
        }
        if ($request->jenis == 2) {
            if (Jenis_biaya_produksi::find(2) == false) {
                Jenis_biaya_produksi::create(['id' => 2, 'nama' => 'Biaya Operasional']);
            }
        }
        if ($request->jenis == 3) {
            if (Jenis_biaya_produksi::find(3) == false) {
                Jenis_biaya_produksi::create(['id' => 2, 'nama' => 'Lainya']);
            }
        }
        $kuantitas = $request->kuantitas;
        if ($request->kuantitas <= 0) {
            $kuantitas = 0;
        }
        $create = Biaya_produksi::create([
            'nama' => $request->nama,
            'satuan_id' => $request->satuan,
            'jenis_biaya_produksi_id' => $request->jenis,
            'kuantitas' => $kuantitas,
            'minimal_pemakaian' => 0,
            'gudang' => 0
        ]);

        if ($create == true) {

            $pesan = ['pesan' => 'Data Satuan Berhasil Ditambahkan', 'alert' => 'success'];
        } else {

            $pesan = ['pesan' => 'Data Satuan Gagal Ditambahkan', 'alert' => 'danger'];
        }
        return redirect()->back()->with($pesan);
    }
    public function delete(Belanja $belanja)
    {
        $delete = $belanja->delete();
        $pesan = ['pesan' => 'Data Belanja Gagal Dihapus', 'alert' => 'success'];
        if ($delete == false) {
            $pesan = ['pesan' => 'Data Belanja Gagal Dihapus', 'alert' => 'danger'];
        }
        return redirect()->back()->with($pesan);
    }
    public function baku(Request $request)
    {
        Biaya_produksi::where('id', $request->bahan)->update(['kuantitas' => $request->kuantitas]);
        return redirect()->back();
    }
}
