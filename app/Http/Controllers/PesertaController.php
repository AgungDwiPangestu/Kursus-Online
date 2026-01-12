<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Kursus;
use Illuminate\Http\Request;

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
        $kursus = Kursus::all();
        return view('peserta.create', compact('kursus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        Peserta::create($validated);

        return redirect()->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan');
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
        $kursus = Kursus::all();
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
