@extends('layouts.public')

@section('title', 'Tambah Pengajar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-person-plus"></i> Tambah Pengajar Baru</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('pengajar.store') }}" method="POST">
                        @csrf

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Pengajar baru akan otomatis dibuatkan akun login dengan role <strong>pengajar</strong>.
                        </div>

                        <div class="mb-3">
                            <label for="nama_pengajar" class="form-label">Nama Pengajar <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_pengajar') is-invalid @enderror"
                                id="nama_pengajar" name="nama_pengajar" value="{{ old('nama_pengajar') }}"
                                placeholder="Masukkan nama lengkap pengajar" required>
                            @error('nama_pengajar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}"
                                placeholder="email@example.com" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Email ini akan digunakan untuk login.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password"
                                placeholder="Minimal 8 karakter" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Ketik ulang password" required>
                        </div>

                        <div class="mb-3">
                            <label for="keahlian" class="form-label">Keahlian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('keahlian') is-invalid @enderror"
                                id="keahlian" name="keahlian" value="{{ old('keahlian') }}"
                                placeholder="Contoh: Web Development, Data Science" required>
                            @error('keahlian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Simpan Pengajar
                            </button>
                            <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection