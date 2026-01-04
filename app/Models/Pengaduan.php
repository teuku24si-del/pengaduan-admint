<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        return $this->belongsTo(kategori_pengaduan::class, 'kategori_id', 'kategori_id');
    }

    public function warga()
    {
        return $this->belongsTo(warga::class, 'warga_id', 'warga_id');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
{
    foreach ($filterableColumns as $column) {
        if ($request->filled($column)) {
            $query->where($column, $request->input($column));
        }
    }
    return $query;
}

public function scopeSearch($query, $request, array $columns)
{
    if ($request->filled('search')) {
        $searchTerm = $request->input('search');

        $query->where(function($q) use ($searchTerm) {
            // Cari berdasarkan no_tiket
            $q->orWhere('no_tiket', 'LIKE', '%' . $searchTerm . '%');

            // Cari berdasarkan judul
            $q->orWhere('judul', 'LIKE', '%' . $searchTerm . '%');

            // Cari berdasarkan lokasi
            $q->orWhere('lokasi_text', 'LIKE', '%' . $searchTerm . '%');

            // Cari berdasarkan deskripsi
            $q->orWhere('deskripsi', 'LIKE', '%' . $searchTerm . '%');

            // Cari berdasarkan nama warga (relasi ke tabel warga)
            $q->orWhereHas('warga', function($wargaQuery) use ($searchTerm) {
                $wargaQuery->where('nama', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            });

            // Cari berdasarkan kategori (relasi ke tabel kategori_pengaduan)
            $q->orWhereHas('kategori', function($kategoriQuery) use ($searchTerm) {
                $kategoriQuery->where('nama', 'LIKE', '%' . $searchTerm . '%');
            });
        });
    }
    return $query;
}
}
