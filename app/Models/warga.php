<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class warga extends Model
{
    protected $table      = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable   = [
        'nama',
        'agama',
        'pekerjaan',
        'jenis_kelamin',
        'email',
        'No_Hp',
    ];

     public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'warga_id', 'warga_id');
    }

}
