<?php

namespace App\Http\Controllers;

use App\peminjaman;
use App\Karyawan;
use App\transaksi_peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $hutang = peminjaman::where('status',1)->get();
        return view('menu.peminjaman.index', compact('hutang'));
    }
    public function create()
    {
        $karyawan = Karyawan::all();

        return view('menu.peminjaman.create', compact('karyawan'));
    }
    public function store(Request $request)
    {
        $request->uang = implode('', explode(',', $request->uang));
        peminjaman::create([
            'karyawan_id' => $request->karyawan,
            'hutang' => $request->uang,
            'tanggal' => $request->tanggal,
            'keterangan' => '-',
            'status' => 1,
        ]);
        return redirect('/peminjaman');
    }
    public function transaksi(Request $request)
    {
        for ($i = 0; $i < count($request->hutang); $i++) {
            $uang = implode('', explode(',', $request->uang[$i]));
            transaksi_peminjaman::create([
                'peminjaman_id' => $request->hutang[$i],
                'nominal_uang' => $uang
            ]);
            $peminjaman = peminjaman::find($request->hutang[$i]);
            if ($peminjaman->transaksi_peminjaman->sum('nominal_uang') == $peminjaman->hutang) {
                $peminjaman->update(['status' => 0]);
            }
        }
        return redirect()->back();
    }
    public function transaksi_karyawan(Request $request, Karyawan $karyawan)
    {
        $peminjaman =  $karyawan->peminjaman->where('tanggal', $request->pinjam)->first();

        $uang = implode('', explode(',', $request->uang));
        transaksi_peminjaman::create([
            'peminjaman_id' => $peminjaman->id,
            'nominal_uang' => $uang
        ]);
        if ($peminjaman->transaksi_peminjaman->sum('nominal_uang') == $peminjaman->hutang) {
            $peminjaman->update(['status' => 0]);
        }
        return redirect()->back();
    }
    protected $belum_dibayar;
    public function karyawan(Karyawan $karyawan)
    {
        $terakhir = Peminjaman::where(['karyawan_id' => $karyawan->id, 'status' => 1])->orderBy('tanggal', 'desc')->first();
        $belum_dibayar
            = Peminjaman::where(['karyawan_id' => $karyawan->id, 'status' => 1])->orderBy('tanggal', 'desc')->get();

        $belum_dibayar->map(function ($belum) {
            $this->belum_dibayar += ($belum->hutang - $belum->transaksi_peminjaman->sum('nominal_uang'));
        });
        $belum_dibayar =     $this->belum_dibayar;
        return view('menu.peminjaman.meminjam', compact('karyawan', 'terakhir', 'belum_dibayar'));
    }
}
