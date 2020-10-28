<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi_karyawan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sesi_id');
            $table->unsignedBigInteger('buat_produk_id');
            $table->unsignedBigInteger('karyawan_id');
            $table->integer('jenis');
            $table->integer('dibuat');
            $table->boolean('status');
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
        Schema::dropIfExists('sesi_karyawan');
    }
}
