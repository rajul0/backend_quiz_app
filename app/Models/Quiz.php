<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'kuis';

    protected $fillable = [
        'nama',
        'daftar_pertanyaan', // Pastikan kolom ini bisa diisi
    ];

    protected $casts = [
        'daftar_pertanyaan' => 'array',
    ];
}
