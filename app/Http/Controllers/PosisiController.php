<?php

namespace App\Http\Controllers;

use App\Exceptions\Helpers\Toasterku;
use App\Posisi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        $store = Posisi::create(['nama' => $request->nama]);
        if ($store == true) {
            $pesan = ['pesan' => 'Data Posisi Berhasil Ditambahkan', 'alert' => 'success', 'tab' => 'posisi'];
        } else {
            $pesan = ['pesan' => 'Data Posisi Gagal Ditambahkan', 'alert' => 'danger', 'tab' => 'posisi'];
        }
        Toastr::success('Posisi Berhasil Ditambahkan', '', Toasterku::config());
        return redirect()->back()->with($pesan);
    }
    public function update(Request $request, Posisi $posisi)
    {
        $request->validate(['nama' => 'required']);
        $update = $posisi->update(['nama' => $request->nama]);
        if ($update == true) {
            $pesan = ['pesan' => 'Data Posisi Berhasil Diubah', 'alert' => 'success', 'tab' => 'posisi'];
        } else {
            $pesan = ['pesan' => 'Data Posisi Gagal Diubah', 'alert' => 'danger', 'tab' => 'posisi'];
        }
        return redirect()->back()->with($pesan);
    }
    public function delete(Posisi $posisi)
    {
        $delete = $posisi->delete(); //Delete data
        if ($delete == true) {
            $pesan = ['pesan' => 'Data Posisi Berhasil Dihapus', 'alert' => 'success', 'tab' => 'posisi'];
        } else {
            $pesan = ['pesan' => 'Data Posisi Gagal Dihapus', 'alert' => 'danger', 'tab' => 'posisi'];
        }
        Toastr::success('Posisi Berhasil Dihapus', '', Toasterku::config());


        return redirect()->back()->with($pesan);
    }
}
