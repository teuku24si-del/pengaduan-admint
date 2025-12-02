<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class media extends Model
{
     use HasFactory;

    // Tentukan nama tabel secara eksplisit (karena defaultnya 'media' -> 'medias' atau 'media')
    // Tapi karena 'media' adalah kata jamak dari 'medium', Laravel mungkin bingung.
    // Lebih aman didefinisikan.
    protected $table = 'media';

    protected $primaryKey = 'media_id'; //

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];
}
