<?php

use App\Satuan;
use App\Karyawan;
use App\Produksi;
use Brian2694\Toastr\Facades\Toastr;
use App\Exceptions\Helpers\Toasterku;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => 'signin',
    'middleware' => 'guest'
], function () {
    Route::get('', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('', 'Auth\LoginController@login');
});

Route::get('/', function () {
    return view('landing');
});
Route::group([
    'prefix' => 'logout',
], function () {
    Route::get('', 'Auth\LogoutController@logout')->name('auth.logout');
});

Route::group([
    'middleware' => ['auth']
], function () {
    
    Route::get('/dashboard', 'DashboardController@index')->name('home');



Route::get('/icon', function () {
    return view('layouts.icon');
});

// Posisi
Route::group(
    ['prefix' => 'posisi',],
    function () {
        Route::post('/store', 'PosisiController@store');
        Route::get('/{posisi}/delete', 'PosisiController@delete');
    }
);
// Karyawan
Route::group(
    ['prefix' => 'karyawan',],
    function () {
        Route::get('', 'KaryawanController@index');
        Route::post('/store', 'KaryawanController@store');
        Route::get('/{karyawan}/delete', 'KaryawanController@delete');
        Route::get('/{karyawan}/detail', 'KaryawanController@profil');
        Route::put('/{karyawan}/update', 'KaryawanController@update');
        Route::put('/{karyawan}/image', 'KaryawanController@update_image');
        Route::get('/{karyawan}/meminjam', 'KaryawanController@meminjam');
        Route::post('/{karyawan}/meminjam', 'PeminjamanController@transaksi_karyawan');
    }
);
Route::group(
    ['prefix' => 'produksi',],
    function () {
        Route::get('', 'BiayaProduksiController@index');
        Route::get('/{produksi}/bagian', 'BiayaProduksiController@bagian');
        Route::post('/store', 'BiayaProduksiController@store');
        Route::get('/{produksi}/delete', 'BiayaProduksiController@delete');
    }
);
Route::group(
    ['prefix' => 'satuan',],
    function () {
        Route::post('/store', 'SatuanController@store');
        Route::get('/{satuan}/delete', 'SatuanController@delete');
    }
);
// Produksi
Route::group(
    ['prefix' => 'suplier',],
    function () {
        Route::get('', 'SuplierController@index');
        Route::post('/store', 'SuplierController@store');
        Route::get('/{suplier}/delete', 'SuplierController@delete');
        Route::get('/{suplier}/detail', 'SuplierController@profil');
        Route::put('/{suplier}/update', 'SuplierController@update');
    }
);
Route::group(
    ['prefix' => 'distributor',],
    function () {
        Route::get('', 'DistributorController@index');
        Route::post('/store', 'DistributorController@store');
        Route::get('/{distributor}/detail', 'DistributorController@profile');
        Route::get('/{distributor}/delete', 'DistributorController@delete');
    }
);
Route::group(
    ['prefix' => 'gudang',],
    function () {
        Route::get('', 'GudangController@index');
        Route::get('/{biaya_produksi}/detail', 'GudangController@detail');
        Route::post('/store', 'GudangController@store');
    }
);
Route::group(
    ['prefix' => 'pengeluaran',],
    function () {
        
        Route::get('', 'PengeluaranController@index');
        Route::get('/histori', 'PengeluaranController@histori');
        Route::post('/store', 'PengeluaranController@store');
    });
Route::group(
    ['prefix' => 'belanja',],
    function () {
        Route::get('', 'BelanjaController@index');
        Route::post('/filter', 'BelanjaController@filter');
        Route::get('/histori', 'BelanjaController@histori');
        Route::post('/store', 'BelanjaController@store');
        Route::post('/store2', 'BelanjaController@store2');
        Route::get('/konfirmasi', 'BelanjaController@respon');
        Route::post('/gudang', 'BelanjaController@store');
        Route::post('/gagal', 'BelanjaController@gagal');
        Route::get('/hutang', 'BelanjaController@hutang');
        Route::post('/hutang', 'BelanjaController@hutang_transaksi');
    }
);
Route::group(
    ['prefix' => 'pesanan',],
    function () {
        Route::get('/create', 'PesananController@create');
        Route::post('/store', 'PesananController@store');
        Route::post('/store/create', 'PesananController@store_create');
        Route::put('/update', 'PesananController@update');
        Route::get('/laporan', 'PesananController@laporan');

        Route::get('', 'PesananController@index');
        Route::get('/bayar', 'PesananController@bayar');
        Route::get('/transaksi', 'PesananController@multi_transaksi');
        Route::post('/transaksi', 'TransaksiPesananController@multi_transaksi');
        Route::post('/{pesanan}/transaksi', 'TransaksiPesananController@transaksi');
        Route::post('/sesi', 'sesiController@create');

        Route::get('/store/{pesanan}/transaksi', 'TransaksiPesananController@store_transaksi');
        Route::post('/store/{pesanan}/transaksi', 'TransaksiPesananController@store_transaksi_create');
        Route::post('/banyak', 'TransaksiPesananController@multi_transaksi');

        Route::group(
            ['prefix' => '{pesanan}',],
            function () {
                Route::post('/bayar', 'TransaksiPesananController@bayar');
                Route::get('/detail', 'pesananController@profil');
                Route::get('/ambil', 'pesananController@ambil');
                Route::get('/detele', 'PesananController@delete');
                Route::get('/edit', 'PesananController@edit');

            }
        );

        Route::group(
            ['prefix' => '{sesi}',],
            function () {
                Route::get('/sesi', 'sesiController@index');
                Route::get('/karyawan', 'sesiController@karyawan');
                Route::get('/create', 'sesiController@buat_adonan');
                Route::get('/selesai', 'sesiController@selesai');
                Route::get('/adonan', 'sesiController@adonan');
                Route::get('/packing', 'PackingController@index');
                Route::get('/rekap', 'sesiController@rekap');

                Route::post('/create', 'AdonanController@adonan2');
                Route::post('/packing', 'PackingController@store');
                Route::post('{pesanan}/serahkan', 'sesiController@serahkan');

            }
        );
    }
);
Route::group(
    ['prefix' => 'adonan',],
    function () {
        Route::post('/{buat_produk}/bahan', 'BuatProdukController@ambil_bahan');
        Route::get('/{buat_produk}/detail', 'BuatProdukController@detail');
        Route::post('/{buat_produk}/detail', 'BuatProdukController@rekap');
        Route::post('/{buat_produk}/karyawan', 'BuatProdukController@karyawan');
        Route::post('/pengaturan', 'AdonanController@pengaturan');
    }
);
Route::post('/buat/{sesi}/karyawan', 'BuatProdukController@store');
Route::group(
    ['prefix' => 'sesi',],
    function () {

        Route::get('/{sesi_produk}/{sesi}/hapus', 'SesiController@pesanan_delete');
        Route::post('/{sesi}/produk', 'SesiController@produk');
        Route::get('/{sesi}/selesai', 'SesiController@selesai');
        Route::post('/{sesi}/pemakaian', 'PemakaianController@store');
        Route::get('/{sesi}/delete', 'SesiController@delete');
    }
);
Route::group(
    ['prefix' => 'gudang',],
    function () {
    }
);
Route::get('potongan', 'PotonganGajiController@show');

Route::group(['prefix' => 'penggajian'], function () {
    Route::
    get('', 'GajiController@index');
    Route::get('potongan', 'PotonganGajiController@index');
    Route::post('potongan', 'PotonganGajiController@store');
});
Route::group(
    ['prefix' => 'pengaturan',],
    function () {
        
        Route::get('', 'PengaturanController@index');
        Route::post('mulai', 'PengaturanController@mulai');
        Route::post('selesai', 'PengaturanController@selesai');
        Route::group(
            ['prefix' => 'profil',],
            function () {
                Route::get('', 'PengaturanController@profile');
                Route::post('', 'PengaturanController@profile_post');

            });
        Route::post('/gaji', 'PengaturanController@gaji_store');
        Route::get('/produk', 'PengaturanController@produk');
        Route::post('/bahan', 'PengaturanController@bahan_baku');
        Route::get('/jadwal', 'PengaturanController@jadwal');
        Route::post('/minimal', 'PengaturanController@minimal_pemakaian');
        Route::put('/{tanggal_gaji}/gaji', 'PengaturanController@gaji_update');
        Route::put('/jumlah', 'PengaturanController@jumlah_produk');
        Route::put('/harga', 'PengaturanController@harga_produk');
        
    }
);
// Route::group(
//     ['prefix' => 'login',],
//     function () {

//         Route::get('', 'AuthController@login')->name('login');
//         Route::post('', 'AuthController@postLogin');
//     }
// );
// Route::get('/logout', 'AuthController@logout');
Route::group(
    ['prefix' => 'absen',],
    function () {
        Route::get('', 'absenController@index');
        Route::post('', 'absenController@absensi');
        Route::get('/histori', 'absenController@histori');
        Route::post('/histori', 'absenController@histori_post');
        Route::get('/{tanggal}/histori', 'absenController@histori_filter');
        Route::get('/{karyawan}/{Ymd}/hadir', 'absenController@absensi_karyawan');
    }
);
Route::group(
    ['prefix' => 'peminjaman',],
    function () {
        Route::get('', 'PeminjamanController@index');
        Route::post('/bayar', 'PeminjamanController@transaksi');
        Route::get('/create', 'PeminjamanController@create');
        Route::post('/store', 'PeminjamanController@store');
    }
);
    Route::group(
        ['prefix' => 'laporan',],
        function () {
Route::get( '', 'LaporanController@index');
Route::post( '/filter', 'LaporanController@filter');


        });
Route::post('/pemakaian/{buat_produk}/store', 'PemakaianController@store');
Route::post('/produksi/baku', 'BiayaProduksiController@baku');
Route::get('/gaji', 'GajiController@index');

Route::post('/pengaturan/{pengaturan_tanggal}/selesai', 'PengaturanController@selesai');
    // Route::post('/pesanan/{sesi}/adonan', 'AdonanController@adonan');
    // Route::put('gaji/{tanggal_gaji}', 'TanggalGajiController@update');
    // Route::post('/sesi/{sesi}/karyawan', 'SesiKaryawanController@store');
    // Route::get('/sesi/{sesi}/{karyawan}/karyawan', 'SesiKaryawanController@delete');
    // Route::post('/sesi/{sesi}/bahan', 'SesiController@ambil_bahan');

});
