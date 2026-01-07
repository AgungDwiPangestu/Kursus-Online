<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kursus_id',
        'status',
        'tanggal_daftar',
        'tanggal_selesai'
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'tanggal_selesai' => 'date'
    ];

    /**
     * Get the user who enrolled.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course enrolled in.
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}
