<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class tindak_lanjut extends Model
{
    protected $table = 'tindak_lanjut';
    public $incrementing = true;
    protected $primaryKey = 'tindak_id';

    protected $fillable = [
        'tindak_id',
        'pengaduan_id',
        'petugas',
        'aksi',
        'catatan'
];
public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');

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

public function scopeSearch($query, $request)
{
    if ($request->filled('search')) {
        $search = $request->search;
        // Mencari berdasarkan kolom 'petugas' ATAU 'no_tiket' di tabel pengaduan
        $query->where(function($q) use ($search) {
            $q->where('petugas', 'LIKE', '%' . $search . '%')
              ->orWhereHas('pengaduan', function($queryPengaduan) use ($search) {
                  $queryPengaduan->where('no_tiket', 'LIKE', '%' . $search . '%');
              });
        });
    }
    return $query;
}



}
