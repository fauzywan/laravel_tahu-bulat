<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiBelanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_belanja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('belanja_id');
            $table->unsignedBigInteger('jenis_transaksi_id');
            $table->date('tanggal');
            $table->integer('nominal_uang');
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
        Schema::dropIfExists('transaksi_belanja');
    }
}
