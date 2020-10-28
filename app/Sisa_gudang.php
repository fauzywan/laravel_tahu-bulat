<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sisa_gudang extends Model
{
    protected $table = "sisa_gudang";
    protected $guarded = [];
    public function gudang()
    {
        return $this->BelongsTo(Gudang::class);
    }
}
