<?php

namespace App\Http\Controllers;

use App\Posisi;
use App\Satuan;
use Illuminate\Http\Request;
use App\Exceptions\Helpers\Toasterku;
use Brian2694\Toastr\Facades\Toastr;

class SatuanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        $create = Satuan::create(['nama' => $request->nama]);
        if ($create == true) {
            Toastr::success('Posisi Berhasil Ditambah', '', Toasterku::config());
        } else {

            Toastr::danger('Gagal Berhasil Ditambah', '', Toasterku::config());
        }

        return redirect()->back();
    }
    public function delete(Satuan $satuan)
    {
        $delete = $satuan->delete();
        $pesan = ['pesan' => 'Data Satuan Berhasil Ditambahkan', 'alert' => 'success', 'tab' => 'ada'];
        if ($delete == false) {
            Toastr::success('Posisi Berhasil Dihapus', '', Toasterku::config());
        }

        return redirect()->back();
    }
}
