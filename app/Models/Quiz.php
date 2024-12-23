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
        'daftar_pertanyaan',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'daftar_pertanyaan' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Accessor untuk properti "available"
    public function getAvailableAttribute()
    {
        return $this->start_time !== null && $this->end_time !== null;
    }

    /**
     * Scope to filter available quizzes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->where('start_time', '<=', now()) // Start time <= current time
            ->where('end_time', '>=', now()); // End time >= current time
    }
}
