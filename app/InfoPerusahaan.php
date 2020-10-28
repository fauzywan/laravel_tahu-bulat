<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoPerusahaan extends Model
{
    protected $table='info_perusahaan';
    protected $fillable=['nama','moto','uang','alamat','pemilik','telepon','email','status'];
}
