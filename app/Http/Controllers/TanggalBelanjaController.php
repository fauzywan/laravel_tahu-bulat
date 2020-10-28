<?php

namespace App\Http\Controllers;

use App\Tanggal_belanja;
use Illuminate\Http\Request;

class TanggalbelanjaController extends Controller
{
    public function index()
    {
        $tanggal = Tanggal_belanja::latest()->first();
        return view('menu.belanja.tanggal', compact('tanggal'));
    }
    public function store(Request $request)
    {
        $create = Tanggal_belanja::create(['tanggal' => $request->tanggal]);
        $pesan = ['pesan' => 'Tanggal Berhasil diatur', 'alert' => 'success'];
        if ($create == false)
            $pesan = ['pesan' => 'Tanggal Gagal diatur', 'alert' => 'danger']; {
        }
        return redirect()->back()->with($pesan);
    }
    public function update(Request $request)
    {
        $update = Tanggal_belanja::latest()->first()->update(['tanggal' => $request->tanggal]);
        $pesan = ['pesan' => 'Tanggal Berhasil diatur', 'alert' => 'success'];
        if ($update == false)
            $pesan = ['pesan' => 'Tanggal Gagal diatur', 'alert' => 'danger']; {
        }
        return redirect()->back()->with($pesan);
    }
}
