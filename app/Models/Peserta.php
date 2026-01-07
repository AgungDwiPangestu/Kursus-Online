<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';

    protected $fillable = [
        'kursus_id',
        'nama_peserta',
        'email'
    ];

    /**
     * Get the course that this participant is enrolled in.
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}
