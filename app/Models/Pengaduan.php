<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    public $incrementing = true;
    protected $primaryKey = 'pengaduan_id';

    protected $fillable = [
        'pengaduan_id',
        'no_tiket',
        'warga_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'status',
        'lokasi_text',
        'rt',
        'rw'



    ];

   public function kategori()
    {
        return $this->belongsTo(Kategori_Pengaduan::class, 'kategori_id', 'kategori_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
}
