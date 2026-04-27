<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model 
{ 
    protected $table = 'table_mata_kuliah';
    
    protected $fillable = [
        'jurusan_id',
        'kode_mk',
        'nama_mk',
        'sks',
        'dosen_id',
    ];
}