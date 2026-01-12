<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Pengajar;
use App\Models\Peserta;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        // If user is pengajar, only show their own courses
        if ($user && $user->isPengajar() && $user->pengajar) {
            $kursus = Kursus::with('pengajar')
                ->where('pengajar_id', $user->pengajar->id)
                ->get();
        } else {
            // Admin and peserta see all courses
            $kursus = Kursus::with('pengajar')->get();
        }

        return view('kursus.index', compact('kursus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengajars = Pengajar::all();
        return view('kursus.create', compact('pengajars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengajar_id' => 'required|exists:pengajar,id',
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        Kursus::create($validated);

        return redirect()->route('kursus.index')
            ->with('success', 'Kursus berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kursus $kursus)
    {
        $kursus->load('pengajar', 'peserta', 'enrollments', 'enrolledUsers');
        return view('kursus.show', compact('kursus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kursus $kursus)
    {
        $pengajars = Pengajar::all();
        return view('kursus.edit', compact('kursus', 'pengajars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kursus $kursus)
    {
        $validated = $request->validate([
            'pengajar_id' => 'required|exists:pengajar,id',
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $kursus->update($validated);

        return redirect()->route('kursus.index')
            ->with('success', 'Kursus berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kursus $kursus)
    {
        $kursus->delete();

        return redirect()->route('kursus.index')
            ->with('success', 'Kursus berhasil dihapus');
    }

    /**
     * Enroll user to a course
     */
    public function enroll(Kursus $kursus)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Check if user is admin
        if ($user->isAdmin()) {
            return redirect()->back()
                ->with('error', 'Admin tidak dapat mendaftar kursus');
        }

        // Check if already enrolled
        $existingEnrollment = $kursus->enrollments()
            ->where('user_id', $user->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()
                ->with('error', 'Anda sudah terdaftar di kursus ini');
        }

        // Create enrollment
        $kursus->enrollments()->create([
            'user_id' => $user->id,
            'status' => 'active',
            'tanggal_daftar' => now(),
        ]);

        // Also add to peserta table for admin view
        Peserta::create([
            'kursus_id' => $kursus->id,
            'nama_peserta' => $user->name,
            'email' => $user->email,
        ]);

        return redirect()->back()
            ->with('success', 'Berhasil mendaftar kursus! Selamat belajar 🎉');
    }

    /**
     * Display participants/peserta for a specific course (for pengajar)
     */
    public function peserta(Kursus $kursus)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Only pengajar who owns this course or admin can see peserta
        if (!$user->isAdmin()) {
            if (!$user->isPengajar() || !$user->pengajar || $kursus->pengajar_id !== $user->pengajar->id) {
                return redirect()->route('kursus.index')
                    ->with('error', 'Anda tidak memiliki akses ke peserta kursus ini');
            }
        }

        // Load enrollments with user data
        $kursus->load(['enrollments.user', 'peserta']);

        return view('kursus.peserta', compact('kursus'));
    }
}
