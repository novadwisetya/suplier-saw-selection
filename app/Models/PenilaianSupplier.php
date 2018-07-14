<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianSupplier extends Model
{
    protected $table = 'penilaian_supplier';

    protected $fillable = [
        'po_number', 'suppliers_id', 'tanggal', 'products_id', 'drum', 'kg', 'satuan', 'jumlah', 'harga', 'mutu', 'layanan', 'pembayaran', 'waktu'
    ];
    
    public function datatables($id)
    {
        return static::select('products_id', 'harga', 'mutu', 'layanan', 'pembayaran', 'waktu')->where('suppliers_id', $id);
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
