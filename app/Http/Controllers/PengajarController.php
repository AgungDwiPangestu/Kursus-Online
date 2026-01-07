<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajars = Pengajar::all();
        return view('pengajar.index', compact('pengajars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengajar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengajar' => 'required|string|max:255',
            'email' => 'required|email|unique:pengajar,email',
            'keahlian' => 'required|string|max:255'
        ]);

        Pengajar::create($validated);

        return redirect()->route('pengajar.index')
            ->with('success', 'Pengajar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajar $pengajar)
    {
        $pengajar->load('kursus');
        return view('pengajar.show', compact('pengajar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajar $pengajar)
    {
        return view('pengajar.edit', compact('pengajar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajar $pengajar)
    {
        $validated = $request->validate([
            'nama_pengajar' => 'required|string|max:255',
            'email' => 'required|email|unique:pengajar,email,' . $pengajar->id,
            'keahlian' => 'required|string|max:255'
        ]);

        $pengajar->update($validated);

        return redirect()->route('pengajar.index')
            ->with('success', 'Pengajar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajar $pengajar)
    {
        $pengajar->delete();

        return redirect()->route('pengajar.index')
            ->with('success', 'Pengajar berhasil dihapus');
    }
}
