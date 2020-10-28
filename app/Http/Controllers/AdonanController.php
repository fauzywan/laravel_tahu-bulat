<?php

namespace App\Http\Controllers;


use App\Belanja;
use App\Buat_produk;
use App\Exceptions\Helpers\Toasterku;
use App\Gudang;
use App\Pemakaian;
use App\peminjaman;
use App\sesi;
use App\sesi_karyawan;
use App\sesi_produk;
use App\pengaturan_produk;
use App\Adonan;
use App\Biaya_produksi;
use App\Tanggal_gaji;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdonanController extends Controller
{

    protected $kuantitas;

    public function pengaturan(Request $request)
    {
        for ($i = 0; $i < count($request->adonan); $i++) {
            if (Adonan::where('biaya_produksi_id', $request->adonan[$i])->count() == 0) {
                Adonan::create(['biaya_produksi_id' => $request->adonan[$i], 'kuantitas' => intval($request->kuantitas[$i])]);
            } else {
                Adonan::where('biaya_produksi_id', $request->adonan[$i])->update(['kuantitas' => intval($request->kuantitas[$i])]);
            }
        }
        // Toastr::success(['Proses Berhasil', ".", Toasterku::config()]);

        return redirect()->back();
    }
    public function adonan(Request $request, Sesi $sesi)
    {

        $create = Buat_produk::create([
            'jumlah' => 0,
            'balo' => $request->adonan,
            'gaji' => 0, 'status' => 1,
            'sesi_produk_id' => $request->pesanan,
            'sesi_id' => $sesi->id,
            'jenis'=>1
        ]);
        if ($create == true) {
            $create = Buat_produk::latest()->first();
            sesi_karyawan::create([
                'sesi_id' => $sesi->id,
                'buat_produk_id' => $create->id,
                'karyawan_id' => $request->karyawan,
                'dibuat' => 0,
                'status' => 1,
                'sesi_produk_id' => $request->pesanan,
                'jenis'=>1
            ]);
            if (isset($request->rekan) && count($request->rekan) > 0) {

                for ($h = 0; $h < count($request->rekan); $h++) {
                    sesi_karyawan::create([
                        'sesi_id' => $sesi->id,
                        'buat_produk_id' => $create->id,
                        'karyawan_id' => $request->rekan[$h],
                        'dibuat' => 0,
                        'status' => $request->pesanan,
                        'jenis'=>0
                    ]);
                }
            }
            // Bahan=biaya_produksi_id
            $sesi_produk = sesi_produk::find($create->sesi_produk_id);
            $sesi_produk->update(['sedang_dibuat' => $sesi_produk->sedang_dibuat + $request->adonan_jumlah]);
            for ($i = 0; $i < count($request->bahan); $i++) {
                $this->kuantitas = $request->kuantitas[$i];
                if ($request->harga[$i] == null) {
                    $belanja =  Belanja::whereRaw("biaya_produksi_id = " . $request->bahan[$i] . " AND status = 1 AND tersedia > 0")->orderBy('created_at', 'asc')->get(['tersedia', 'id', 'harga_satuan']);
                } else {
                    $belanja =  Belanja::whereRaw("biaya_produksi_id = " . $request->bahan[$i] . " AND status = 1 AND tersedia > 0 AND harga_satuan=" . $request->harga[$i])->orderBy('created_at', 'asc')->get(['tersedia', 'id', 'harga_satuan']);
                }
                foreach ($belanja as $b) {
                    if ($this->kuantitas != 0) {
                        if ($b->tersedia - $this->kuantitas <= 0) {
                            $pemakian = $b->tersedia;
                            $b->update(['tersedia' => 0, 'status' => 0]);
                        } else {
                            $pemakian = $b->tersedia - ($b->tersedia - $this->kuantitas);
                            $b->update(['tersedia' => $b->tersedia - $this->kuantitas]);
                            $this->kuantitas = 0;
                        }
                        Pemakaian::create([
                            'buat_produk_id' => $create->id,
                            'karyawan_id' => $request->karyawan,
                            'belanja_id' => $b->id,
                            'jumlah' => $pemakian,
                            'harga' => $pemakian *  $b->harga_satuan,
                            'tanggal' => $request->tanggal,
                            'sesi_id' => $sesi->id
                        ]);
                    }
                }
            };
        }
        Toastr::success(['Adonan Berhasil Dibuat', '', Toasterku::config()]);
        return redirect()->back();
    }
    public function adonan2(Request $request, Sesi $sesi)
    {
        $create = Buat_produk::create([
            'jumlah' => 0,
            'balo' => $request->adonan,
            'gaji' => 0,
            'status' => 1,
            'sesi_produk_id' => 0,
            'sesi_id' => $sesi->id,
        ]);
        if ($create == true) {
            $create = Buat_produk::latest()->first();
            sesi_karyawan::create([
                'sesi_id' => $sesi->id,
                'buat_produk_id' => $create->id,
                'karyawan_id' => $request->karyawan,
                'dibuat' => 0,
                'status' => 1,
                'jenis'=>1
                // 'sesi_produk_id' => 0,
            ]);
            if (isset($request->rekan) && count($request->rekan) > 0) {

                for ($h = 0; $h < count($request->rekan); $h++) {
                    sesi_karyawan::create([
                        'sesi_id' => $sesi->id,
                        'buat_produk_id' => $create->id,
                        'karyawan_id' => $request->rekan[$h],
                         'dibuat' => 0,
                        'status' => 0,
                        'jenis'=>0
                    ]);
                }
            }

            for ($i = 0; $i < count($request->bahan); $i++) {
                $this->kuantitas = $request->kuantitas[$i];
                if ($request->harga[$i] == null) {
                    $belanja =  Belanja::whereRaw("biaya_produksi_id = " . $request->bahan[$i] . " AND status = 1 AND tersedia > 0")->orderBy('created_at', 'asc')->get(['tersedia', 'id', 'harga_satuan']);
                } else {
                    $belanja =  Belanja::whereRaw("biaya_produksi_id = " . $request->bahan[$i] . " AND status = 1 AND tersedia > 0 AND harga_satuan=" . $request->harga[$i])->orderBy('created_at', 'asc')->get(['tersedia', 'id', 'harga_satuan']);
                }
                foreach ($belanja as $b) {
                    if ($this->kuantitas != 0) {
                        if ($b->tersedia - $this->kuantitas <= 0) {
                            $pemakian = $b->tersedia;
                            $b->update(['tersedia' => 0, 'status' => 0]);
                        } else {
                            $pemakian = $b->tersedia - ($b->tersedia - $this->kuantitas);
                            $b->update(['tersedia' => $b->tersedia - $this->kuantitas]);
                            $this->kuantitas = 0;
                        }
                        Pemakaian::create([
                            'buat_produk_id' => $create->id,
                            'karyawan_id' => $request->karyawan,
                            'belanja_id' => $b->id,
                            'jumlah' => $pemakian,
                            'harga' => $pemakian *  $b->harga_satuan,
                            'tanggal' => $request->tanggal,
                            'sesi_id' => $sesi->id
                        ]);
                    }
                }
            };
        }
        return redirect()->back();
    }
}
