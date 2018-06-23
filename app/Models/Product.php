<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'banner';

    protected $fillable = [
        'kode_supplier', 'nama_supplier', 'alamat', 'phone', 'email'
    ];
}
