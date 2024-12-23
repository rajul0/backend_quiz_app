<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKuis extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kuis';

    protected $fillable = [
        'id_kuis',
        'id_user',
        'nilai',
        'attempt_date',
    ];

    // Relasi ke tabel kuis
    public function quiz()
    {

        return $this->belongsTo(Quiz::class, 'id');
    }

    // Relasi ke tabel pengguna
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
