<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penilaian_layanan extends Model
{
     protected $table = 'penilaian_layanan';
    public $incrementing = true;
    protected $primaryKey = 'penilaian_id';

    protected $fillable = [
        'penilaian_id',
        'pengaduan_id',
        'rating',
        'komentar'

];

public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');

    }
}
