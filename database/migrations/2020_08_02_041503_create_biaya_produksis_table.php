<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiayaProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biaya_produksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('satuan_id');
            $table->unsignedBigInteger('jenis_biaya_produksi_id');
            $table->string('nama');
            $table->integer('kuantitas');
            $table->integer('minimal_pemakaian');
            $table->boolean('gudang');
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
        Schema::dropIfExists('biaya_produksi');
    }
}
