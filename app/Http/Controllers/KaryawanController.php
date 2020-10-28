<?php

namespace App\Http\Controllers;

use App\absen as Absen;
use App\Exceptions\Helpers\Toasterku;
use App\Posisi;
use App\Karyawan;
use App\Tanggal_gaji;
use App\Exports\UserExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport;
use App\peminjaman;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class KaryawanController extends Controller
{
    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
    public function import(Request $request)
    {
        $file = $request->file('file');

        // $file->move(base_path() . '/public/excel/', $file->getClientOriginalName());
        // return $file->getClientOriginalName();
        $array = Excel::toCollection(new UsersImport, base_path('/public/excel/') . $file->getClientOriginalName());
        return dd($array);
        return redirect('/')->with('success', 'All good!');
    }



    public function index()
    {
        $karyawan = Karyawan::paginate(5);
        $posisi = Posisi::all();
        $tanggal_gaji = Tanggal_gaji::latest()->first('tanggal');
        if ($tanggal_gaji == false) {
            $tanggal_gaji = null;
        } else {
            $tanggal_gaji = $tanggal_gaji->tanggal;
        }

        $jumlah = Karyawan::count();
        $hadir = Absen::where('tanggal', date('y-m-d'))->count();

        return view('menu.karyawan.index', compact('karyawan', 'posisi', 'tanggal_gaji', 'hadir', 'jumlah'));
    }
    public function search(Request $request)
    {

        $posisi = '';
        if ($request->posisi != 0) {
            $posisi = "AND posisi_id = $request->posisi";
        }
        $karyawan = Karyawan::whereRaw("nama LIKE '%$request->nama%' $posisi ")->paginate(5);
        $posisi = Posisi::all();
        return view('menu.karyawan.index', compact('karyawan', 'posisi'))->with('paginate', true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|alpha',
            'jk' => 'required',
            'posisi' => 'required',
            'alamat' => 'nullable',
            'kerja' => 'nullable'
        ]);
        $alamat = $request->alamat;
        if ($request->alamat == null) {
            $alamat = "Belum Tercantum";
        }
        $telepon = $request->telepon;
        if ($request->telepon == null) {
            $telepon = 0;
        }
        $create = Karyawan::create([
            'nama' => $request->nama,
            'posisi_id' => $request->posisi,
            'jenis_kelamin' => $request->jk,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'created_at' => $request->kerja,
            'gambar' => ''
        ]);

        if ($create == true) {;
            $pesan =  [
                'pesan' => "Data Karyawan Berhasil ditambahkan",
                "alert" => "success"
            ];
        } else {
            $pesan =  [
                'pesan' => "Data Karyawan Gagal ditambahkan",
                "alert" => "danger"
            ];
        }

        return redirect()->back()->with($pesan);
    }
    public function update_image(Request $request, Karyawan $karyawan)
    {
        if ($request->gambar != null) {

            $request->validate(['gambar' => 'mimes:png,jpg,jpeg']); //Validasi
            $gambar = $request->file('gambar');
            $extension = $gambar->getClientOriginalExtension();
            $nama = $karyawan->nama . "." . $extension;
            $jpg = 'img/karyawan/' . $karyawan->nama . ".jpg";
            $png = 'img/karyawan/' . $karyawan->nama . ".png";
            if (File::exists($jpg)) {

                File::delete($jpg);
            }

            if (File::exists($png)) {

                File::delete($png);
            }


            $gambar->move('./img/karyawan', $nama);
            $karyawan->update(['gambar' => $nama]);
        } else {
            $karyawan->update(['gambar' => '']);
        }

        Toastr::success('Gambar Berhasil Diubah', '', Toasterku::config());
        return redirect()->back();
    }
    public function update(Request $request, Karyawan $karyawan)
    {

        $request->validate(['nama' => 'required', 'posisi' => 'required']);
        $update = $karyawan->update([
            'nama' => $request->nama,
            'posisi_id' => $request->posisi,
            'jenis_kelamin' => $request->jk,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'created_at' => $request->kerja,
        ]);

        if ($update == true) {

            $pesan = [
                'pesan' => "Data Karyawan Berhasil diubah",
                "alert" => "success"
            ];
        } else {
            $pesan = [
                'pesan' => "Data Karyawan Gagal diubah",
                "alert" => "danger"
            ];
        }
        return redirect()->back()->with($pesan);
    }
    public function delete(Karyawan $karyawan)
    {

        $delete = $karyawan->delete();
        if ($delete == true) {

            $pesan = [
                'pesan' => "Data Karyawan Berhasil dihapus",
                "alert" => "success"
            ];
        } else {
            $pesan = [
                'pesan' => "Data Karyawan Gagal dihapus",
                "alert" => "danger"
            ];
        }
        return redirect('/karyawan')->with($pesan);
    }
    public function profil(Karyawan $karyawan)
    {
        $gambar = $karyawan->gambar;

        $posisi = Posisi::all();
        return view('menu.karyawan.profile', compact('karyawan', 'posisi', 'gambar'));
    }
    protected $belum_dibayar;
    public function meminjam(Karyawan $karyawan)
    {
        $terakhir = Peminjaman::where(['karyawan_id' => $karyawan->id, 'status' => 1])->orderBy('tanggal', 'desc')->first();
        $belum_dibayar
            = Peminjaman::where(['karyawan_id' => $karyawan->id, 'status' => 1])->orderBy('tanggal', 'desc')->get();

        $belum_dibayar->map(function ($belum) {
            $this->belum_dibayar += ($belum->hutang - $belum->transaksi_peminjaman->sum('nominal_uang'));
        });
        $belum_dibayar =     $this->belum_dibayar;
        return view('menu.karyawan.meminjam', compact('karyawan', 'terakhir', 'belum_dibayar'));
    }
}
