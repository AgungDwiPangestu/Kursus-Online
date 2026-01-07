<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;

    protected $table = 'kursus';

    protected $fillable = [
        'pengajar_id',
        'nama_kursus',
        'deskripsi'
    ];

    /**
     * Get the instructor that teaches this course.
     */
    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    /**
     * Get all participants of this course.
     */
    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    /**
     * Get all enrollments for this course.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get all enrolled users for this course.
     */
    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('status', 'tanggal_daftar', 'tanggal_selesai')
            ->withTimestamps();
    }
}
