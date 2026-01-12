@extends('layouts.public')

@section('title', 'Edit Kursus')

@section('styles')
<style>
    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
        color: white;
        padding: 30px;
    }

    .form-body {
        padding: 40px;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-card">
            <div class="form-header">
                <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Kursus</h4>
            </div>
            <div class="form-body">
                <form action="{{ route('kursus.update', $kursus) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="pengajar_id" class="form-label">Pengajar</label>
                        <select class="form-select @error('pengajar_id') is-invalid @enderror"
                            id="pengajar_id" name="pengajar_id" required>
                            <option value="">Pilih Pengajar</option>
                            @foreach($pengajars as $pengajar)
                            <option value="{{ $pengajar->id }}"
                                {{ old('pengajar_id', $kursus->pengajar_id) == $pengajar->id ? 'selected' : '' }}>
                                {{ $pengajar->nama_pengajar }}
                            </option>
                            @endforeach
                        </select>
                        @error('pengajar_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_kursus" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control @error('nama_kursus') is-invalid @enderror"
                            id="nama_kursus" name="nama_kursus"
                            value="{{ old('nama_kursus', $kursus->nama_kursus) }}" required>
                        @error('nama_kursus')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                            id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gradient">
                            <i class="bi bi-check-lg me-2"></i>Update
                        </button>
                        <a href="{{ route('kursus.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection