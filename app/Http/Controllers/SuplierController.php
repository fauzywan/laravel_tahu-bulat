<?php

namespace App\Http\Controllers;

use App\Belanja;
use App\Exceptions\Helpers\Toasterku;
use App\Suplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuplierController extends Controller
{
    public function index()
    {
        $suplier = Suplier::orderBy('nama', 'asc')->get();
        return view('menu.suplier.index', compact('suplier'));
    }
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required', 'pemilik' => 'nullable', 'telepon' => 'numeric|nullable', 'alamat' => 'nullable']);

        if ($request->pemilik == null) {
            $request->pemilik = "-";
        }

        if ($request->telepon == null) {
            $request->telepon = 0;
        }
        if ($request->alamat == null) {
            $request->alamat = "-";
        }
        $create = Suplier::create(['nama' => $request->nama, 'pemilik' => $request->pemilik, 'telepon' => $request->telepon, 'alamat' => $request->alamat]);
        $pesan = ['pesan' => 'Data Suplier Berhasil ditambahkan', 'alert' => 'success'];
        if ($create == false) {
            $pesan = ['pesan' => 'Data Suplier Gagal ditambahkan', 'alert' => 'danger'];
        } else {
        }
        return redirect()->back()->with($pesan);
    }
    protected $hutang;
    public function profil(Suplier $suplier)
    {
        $suplier->belanja->where('hutang', 1)->map(function ($belanja) {
            $this->hutang += ($belanja->harga - $belanja->transaksi_belanja->sum('nominal_uang'));
        });
        $hutang = $this->hutang;
        $belanja = Belanja::whereRaw("tersedia > 0 AND suplier_id = '$suplier->id'")->get();
        return view('menu.suplier.profile', compact('suplier', 'hutang', 'belanja'));
    }
    public function update(Suplier $suplier, Request $request)
    {
        $suplier->update([
            'nama' => $request->nama,
            'pemilik' => $request->pemilik,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ]);
        Toastr::success('Berhasil Diperbarui', '', Toasterku::config());
        return redirect()->back();
    }
    public function delete(Suplier $suplier)
    {
        $delete = $suplier->delete();
        $pesan = ['pesan' => 'Data suplier Berhasil dihapus', 'alert' => 'success'];
        if ($delete == false) {
            $pesan = ['pesan' => 'Data suplier Gagal dihapus', 'alert' => 'danger'];
        }

        return redirect()->back()->with($pesan);
    }
}
