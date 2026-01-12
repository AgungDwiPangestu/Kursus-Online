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
        $pesertas = Peserta::with('kursus')->get();
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
}
