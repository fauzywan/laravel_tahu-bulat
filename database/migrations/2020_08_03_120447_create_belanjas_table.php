<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belanja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suplier_id');
            $table->unsignedBigInteger('biaya_produksi_id');
            $table->boolean('hutang');
            $table->string('nomor_faktur');
            $table->integer('harga');
            $table->integer('harga_satuan');
            $table->integer('kuantitas');
            $table->integer('tersedia');
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
        Schema::dropIfExists('belanja');
    }
}
