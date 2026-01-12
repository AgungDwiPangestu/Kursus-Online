<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajars = Pengajar::with('user')->get();
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
            'email' => 'required|email|unique:users,email|unique:pengajar,email',
            'password' => 'required|string|min:8|confirmed',
            'keahlian' => 'required|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            // Create user account with pengajar role
            $user = User::create([
                'name' => $validated['nama_pengajar'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'pengajar',
            ]);

            // Create pengajar profile linked to user
            Pengajar::create([
                'user_id' => $user->id,
                'nama_pengajar' => $validated['nama_pengajar'],
                'email' => $validated['email'],
                'keahlian' => $validated['keahlian'],
            ]);

            DB::commit();

            return redirect()->route('pengajar.index')
                ->with('success', 'Pengajar berhasil ditambahkan! Akun login: ' . $validated['email']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pengajar: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajar $pengajar)
    {
        $pengajar->load('kursus', 'user');
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

        DB::beginTransaction();
        try {
            // Update pengajar profile
            $pengajar->update($validated);

            // Update linked user if exists
            if ($pengajar->user) {
                $pengajar->user->update([
                    'name' => $validated['nama_pengajar'],
                    'email' => $validated['email'],
                ]);
            }

            DB::commit();

            return redirect()->route('pengajar.index')
                ->with('success', 'Pengajar berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui pengajar: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajar $pengajar)
    {
        DB::beginTransaction();
        try {
            // Delete linked user if exists
            if ($pengajar->user) {
                $pengajar->user->delete();
            }

            $pengajar->delete();

            DB::commit();

            return redirect()->route('pengajar.index')
                ->with('success', 'Pengajar berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menghapus pengajar: ' . $e->getMessage());
        }
    }
}
