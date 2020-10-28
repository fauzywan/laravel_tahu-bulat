<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanggal_belanja extends Model
{

    //jenis 0=Tanggal Belanja Lainhnya
    //jenis 1=Tanggal Belanja Penyetokan

    protected $table = "tanggal_belanja";
    protected $guarded = [];
}
