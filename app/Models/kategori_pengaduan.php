<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori_pengaduan extends Model
{
    protected $table      ='kategori_pengaduan';
    protected $primaryKey ='kategori_id';
    protected $fillable   =[
        'nama',
        'sla_hari',
        'prioritas',
    ];
}
