<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $table = 'sub_kriterias';

    protected $fillable = [
        'kriterias_id', 'sub_kriteria', 'nilai', 'kriteria_nilai'
    ];
    
    public function datatables($id)
    {
        return static::select('id', 'sub_kriteria', 'nilai', 'kriteria_nilai')->where('kriterias_id', $id);
    }
}