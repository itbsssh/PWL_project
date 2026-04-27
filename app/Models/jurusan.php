<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model 
{ 
    protected $table = 'table_jurusan';
    
    protected $fillable = [
        'nama_jurusan',
        'kode_jurusan',
    ];
}