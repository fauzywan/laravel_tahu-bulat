<?php

namespace App\Http\Controllers;

use App\absen;
use App\Exceptions\Helpers\Toasterku;
use App\Karyawan;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    // protected $hadir = [];
    protected $belum_hadir = [];
    public function index()
    {
        $karyawan = Karyawan::orderBy('nama')->get();

        $karyawan->map(function ($k) {
            if ($k->absen->where('tanggal', date('Y-m-d'))->count() == 0) {

                $this->belum_hadir[] = $k;
            }
        });
        $belum_hadir = $this->belum_hadir;
        $hadir = absen::where('tanggal', date('Y-m-d'))->orderBy('created_at', 'desc')->get();
        return view('menu.absen.index', compact('belum_hadir', 'hadir'));
    }
    public function absensi(Request $request)
    {
        for ($i = 0; $i < count($request->karyawan); $i++) {
            absen::create([
                'tanggal' => $request->tanggal,
                'karyawan_id' => $request->karyawan[$i],

            ]);
        }
        Toastr::success('Proses Berhasil', '', Toasterku::config());
        return redirect()->back();
    }
    public function absensi_karyawan($karyawan, $Ymd)
    {

        $tanggal = substr($Ymd, 0, 4) . "-" . substr($Ymd, 4, 2) . "-" . substr($Ymd, 6, 2);
        absen::create([
            'tanggal' => $tanggal,
            'karyawan_id' => $karyawan,
        ]);
        Toastr::success('Proses Berhasil', '', Toasterku::config());
        return redirect()->back();
    }
    public function histori()
    {
        $absen = absen::distinct('tanggal')->orderBy('tanggal', 'desc')->get('tanggal');
        $tanggal = absen::distinct('tanggal')->orderBy('tanggal', 'desc')->get('tanggal');

        return view('menu.absen.histori', compact('absen','tanggal'));
    }
    public function histori_post(Request $request)
    {
        $tanggal = $request->tanggal;
        $hadir = absen::where('tanggal', $request->tanggal)->get();
        $absen = absen::distinct('tanggal')->orderBy('tanggal', 'desc')->get('tanggal');
        return view('menu.absen.histori_filter', compact('absen', 'hadir', 'tanggal'));
    }
    public function histori_filter($tanggal)
    {
    }
}
