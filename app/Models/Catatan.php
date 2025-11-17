<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catatan extends Model
{
    use HasFactory;

    protected $table = 'catatan';
    protected $fillable = [
        'user_id',
        'judul',
        'isi',
    ];

    // Relasi ke user
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
