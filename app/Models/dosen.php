<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model 
{ 
    protected $table = 'table_dosen';
    
    protected $fillable = [
        'fullname',
        'NIP',
        'NIDN',
        'pendidikan_terakhir',
        'jurusan_id',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat'
    ];
}