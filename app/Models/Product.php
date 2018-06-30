<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'kategori_barang', 'jenis_barang', 'suppliers_id'
    ];
    
    public function datatables()
    {
        return static::select('id', 'kode_barang', 'nama_barang', 'kategori_barang', 'jenis_barang');
    }
    public function dtedit()
    {
        return static::select('kode_supplier', 'nama_supplier');
    }

    public function getData()
    {
        return static::select('id', 'kode_supplier', 'nama_supplier')->get();
    }
}
