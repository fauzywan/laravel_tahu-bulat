<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distributor_id');
            $table->unsignedBigInteger('jenis_transaksi_id');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('diterima');
            $table->integer('harga_satuan');
            $table->integer('biaya_akomodasi');
            $table->integer('harga');
            $table->integer('potongan_harga');
            $table->boolean('status');
            $table->boolean('keuangan');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
