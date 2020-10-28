<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinimalPemakaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minimal_pemakaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biaya_produksi_id');
            $table->integer('minimal');
            $table->integer('potongan');
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
        Schema::dropIfExists('minimal_pemakaian');
    }
}
