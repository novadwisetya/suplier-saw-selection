<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'kode_supplier', 'nama_supplier', 'alamat', 'phone', 'email'
    ];

    public function datatables()
    {
        return static::select('id', 'kode_supplier', 'nama_supplier', 'phone', 'email');
    }
    public function dtedit()
    {
        return static::select('kode_supplier', 'nama_supplier');
    }
}
