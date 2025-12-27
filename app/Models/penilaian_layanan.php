<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        $query->where(function($q) use ($search) {
            // Mencari berdasarkan komentar di tabel penilaian
            $q->where('komentar', 'LIKE', '%' . $search . '%')
              // ATAU mencari berdasarkan no_tiket di tabel pengaduan
              ->orWhereHas('pengaduan', function($queryPengaduan) use ($search) {
                  $queryPengaduan->where('no_tiket', 'LIKE', '%' . $search . '%');
              });
        });
    }
    return $query;
}


}
