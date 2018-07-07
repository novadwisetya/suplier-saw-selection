<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';

    protected $fillable = [
        'kriteria', 'bobot', 'keterangan'
    ];
    
    public function datatables()
    {
        return static::select('id', 'kriteria', 'bobot', 'keterangan');
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
