<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pengaturan/buka', 'ApiController@buka_toko');
Route::get('/pengaturan/tutup', 'ApiController@tutup_toko');
Route::get('/karyawan/{karyawan}/{tanggal}', 'ApiController@karyawan');
Route::get('/produksi/{produksi}/{jenis}', 'ApiController@searchProduksi');
Route::get('/merk/{merk}/select', 'ApiController@merkSelect');
Route::get('/belanja/add', 'ApiController@addBelanja');
Route::get('/belanja/adder', 'ApiController@addBelanja2');
Route::get('/sotong', 'ApiController@get_harga_sotong');
Route::get('/sotong/{harga}/harga', 'ApiController@set_harga_sotong');
Route::get('/sotong/{jumlah}/jumlah', 'ApiController@set_jumlah_sotong');
Route::get('/pengaturan/{baku}/{kuantitas}/bahan', 'ApiController@bahan_baku');
Route::get('/pengaturan/{jumlah}/{kuantitas}/jumlah', 'ApiController@jumlah_baku_gudang');
Route::get('/pengaturan/{kuantitas}/adonan', 'ApiController@adonan');
