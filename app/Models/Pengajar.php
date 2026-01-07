<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $table = 'pengajar';

    protected $fillable = [
        'user_id',
        'nama_pengajar',
        'email',
        'keahlian'
    ];

    /**
     * Get the user associated with pengajar.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all courses taught by this instructor.
     */
    public function kursus()
    {
        return $this->hasMany(Kursus::class);
    }
}
