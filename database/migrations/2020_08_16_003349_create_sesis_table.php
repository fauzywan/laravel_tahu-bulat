<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('dibuat');
            $table->integer('dikemas');
            $table->integer('harga');
            $table->integer('balo');
            $table->integer('rata_rata');
            $table->integer('laba');
            $table->boolean('status');
            $table->string('inisial');
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
        Schema::dropIfExists('sesi');
    }
}
