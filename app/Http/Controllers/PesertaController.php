<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Kursus;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Group peserta by email to show one card per user with all their courses
        $pesertas = Peserta::with('kursus')
            ->get()
            ->groupBy('email')
            ->map(function ($group) {
                return [
                    'nama_peserta' => $group->first()->nama_peserta,
                    'email' => $group->first()->email,
                    'kursus_list' => $group->pluck('kursus')->filter(),
                    'peserta_ids' => $group->pluck('id'),
                    'created_at' => $group->first()->created_at,
                ];
            });

        return view('peserta.index', compact('pesertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kursus = Kursus::with('pengajar')->get();
        // Get users with role peserta
        $users = User::where('role', 'peserta')->orderBy('name')->get();
        return view('peserta.create', compact('kursus', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $registrationType = $request->input('registration_type', 'existing');

        if ($registrationType === 'existing') {
            // Use existing user
            $validated = $request->validate([
                'kursus_id' => 'required|exists:kursus,id',
                'user_id' => 'required|exists:users,id',
            ]);

            $user = User::findOrFail($validated['user_id']);

            // Check if already enrolled
            $existingEnrollment = Enrollment::where('user_id', $user->id)
                ->where('kursus_id', $validated['kursus_id'])
                ->exists();

            if ($existingEnrollment) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'User sudah terdaftar di kursus ini!');
            }

            // Check if peserta record exists
            $existingPeserta = Peserta::where('email', $user->email)
                ->where('kursus_id', $validated['kursus_id'])
                ->exists();

            if ($existingPeserta) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Peserta sudah terdaftar di kursus ini!');
            }

            DB::beginTransaction();
            try {
                // Create peserta record
                Peserta::create([
                    'kursus_id' => $validated['kursus_id'],
                    'nama_peserta' => $user->name,
                    'email' => $user->email,
                ]);

                // Create enrollment
                Enrollment::create([
                    'user_id' => $user->id,
                    'kursus_id' => $validated['kursus_id'],
                    'status' => 'active',
                ]);

                DB::commit();

                return redirect()->route('peserta.index')
                    ->with('success', 'Peserta ' . $user->name . ' berhasil didaftarkan ke kursus!');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mendaftarkan peserta: ' . $e->getMessage());
            }
        } else {
            // Create new user
            $validated = $request->validate([
                'kursus_id' => 'required|exists:kursus,id',
                'nama_peserta' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            DB::beginTransaction();
            try {
                // Create user account with peserta role
                $user = User::create([
                    'name' => $validated['nama_peserta'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => 'peserta',
                ]);

                // Create peserta record
                Peserta::create([
                    'kursus_id' => $validated['kursus_id'],
                    'nama_peserta' => $validated['nama_peserta'],
                    'email' => $validated['email'],
                ]);

                // Create enrollment
                Enrollment::create([
                    'user_id' => $user->id,
                    'kursus_id' => $validated['kursus_id'],
                    'status' => 'active',
                ]);

                DB::commit();

                return redirect()->route('peserta.index')
                    ->with('success', 'Peserta berhasil ditambahkan! Akun login: ' . $validated['email']);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal menambahkan peserta: ' . $e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Peserta $peserta)
    {
        $peserta->load('kursus');
        return view('peserta.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peserta $peserta)
    {
        $kursus = Kursus::with('pengajar')->get();
        return view('peserta.edit', compact('peserta', 'kursus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        $peserta->update($validated);

        return redirect()->route('peserta.index')
            ->with('success', 'Peserta berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('peserta.index')
            ->with('success', 'Peserta berhasil dihapus');
    }

    /**
     * Remove all enrollments for a user.
     */
    public function deleteAll(Request $request)
    {
        $pesertaIds = $request->input('peserta_ids', []);

        if (empty($pesertaIds)) {
            return redirect()->route('peserta.index')
                ->with('error', 'Tidak ada data yang dihapus');
        }

        Peserta::whereIn('id', $pesertaIds)->delete();

        return redirect()->route('peserta.index')
            ->with('success', 'Semua pendaftaran kursus berhasil dihapus');
    }
}
