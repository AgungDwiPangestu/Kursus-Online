@extends('layouts.public')

@section('title', 'Tambah Kursus')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Kursus Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kursus.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="pengajar_id" class="form-label">Pengajar</label>
                            <select class="form-select @error('pengajar_id') is-invalid @enderror"
                                id="pengajar_id" name="pengajar_id" required>
                                <option value="">Pilih Pengajar</option>
                                @foreach($pengajars as $pengajar)
                                <option value="{{ $pengajar->id }}" {{ old('pengajar_id') == $pengajar->id ? 'selected' : '' }}>
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
                                id="nama_kursus" name="nama_kursus" value="{{ old('nama_kursus') }}" required>
                            @error('nama_kursus')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kursus.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection