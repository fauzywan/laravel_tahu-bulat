<?php

namespace App\Http\Controllers;

use App\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        $distributor = Distributor::all();
        return view('menu.distributor.index', compact('distributor'));
    }
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required', 'pemilik' => 'nullable', 'telepon' => 'nullable|numeric', 'alamat' => 'nullable']);

        if ($request->telepon == null) {
            $request->telepon = 0;
        }
        if ($request->pemilik == null) {
            $request->pemilik = "-";
        }

        if ($request->alamat == null) {
            $request->alamat = "-";
        }


        $create = Distributor::create(['nama' => $request->nama, 'pemilik' => $request->pemilik, 'telepon' => $request->telepon, 'alamat' => $request->alamat]);
        $pesan = ['pesan' => 'Data Distributor Berhasil Ditambahkan', 'alert' => 'success'];
        if ($create == false) {
            $pesan = ['pesan' => 'Data Distributor Gagal Ditambahkan', 'alert' => 'danger'];
        }
        return redirect()->back()->with($pesan);
    }
    public function delete(Distributor $distributor)
    {

        $delete = $distributor->delete();
        $pesan = ['pesan' => 'Data Distributor Berhasil dihapus', 'alert' => 'success'];
        if ($delete == false) {
            $pesan = ['pesan' => 'Data Distributor Gagal dihapus', 'alert' => 'danger'];
        }
        return redirect()->back()->with($pesan);
    }
    public function profile(Distributor $distributor)
    {

        return view('menu.distributor.profile', compact('distributor'));
    }
}
