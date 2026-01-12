@extends('layouts.app')

@section('title', 'Tambah Peserta')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="bi bi-person-plus"></i> Tambah Peserta Baru</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="kursus_id" class="form-label">Pilih Kursus <span class="text-danger">*</span></label>
                        <select class="form-select @error('kursus_id') is-invalid @enderror"
                            id="kursus_id" name="kursus_id" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach($kursus as $item)
                            <option value="{{ $item->id }}" {{ old('kursus_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kursus }} ({{ $item->pengajar->nama_pengajar ?? 'Tanpa Pengajar' }})
                            </option>
                            @endforeach
                        </select>
                        @error('kursus_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Tipe Pendaftaran <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="registration_type" id="existing_user"
                                value="existing" {{ old('registration_type', 'existing') == 'existing' ? 'checked' : '' }}>
                            <label class="form-check-label" for="existing_user">
                                <i class="bi bi-person-check"></i> Pilih dari User yang Sudah Ada
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="registration_type" id="new_user"
                                value="new" {{ old('registration_type') == 'new' ? 'checked' : '' }}>
                            <label class="form-check-label" for="new_user">
                                <i class="bi bi-person-plus"></i> Buat User Baru
                            </label>
                        </div>
                    </div>

                    <!-- Existing User Section -->
                    <div id="existing_user_section" class="border rounded p-3 mb-3 bg-light">
                        <h6 class="mb-3"><i class="bi bi-person-check"></i> Pilih User yang Sudah Terdaftar</h6>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select class="form-select @error('user_id') is-invalid @enderror"
                                id="user_id" name="user_id">
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Menampilkan user dengan role peserta yang belum terdaftar di kursus ini.</div>
                        </div>
                    </div>

                    <!-- New User Section -->
                    <div id="new_user_section" class="border rounded p-3 mb-3" style="display: none;">
                        <h6 class="mb-3"><i class="bi bi-person-plus"></i> Buat Akun Peserta Baru</h6>

                        <div class="alert alert-info small">
                            <i class="bi bi-info-circle"></i> Peserta baru akan otomatis dibuatkan akun login dengan role <strong>peserta</strong>.
                        </div>

                        <div class="mb-3">
                            <label for="nama_peserta" class="form-label">Nama Peserta</label>
                            <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror"
                                id="nama_peserta" name="nama_peserta" value="{{ old('nama_peserta') }}"
                                placeholder="Masukkan nama lengkap">
                            @error('nama_peserta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}"
                                placeholder="email@example.com">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Email ini akan digunakan untuk login.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Minimal 8 karakter">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Ketik ulang password">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Daftarkan Peserta
                        </button>
                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const existingRadio = document.getElementById('existing_user');
        const newRadio = document.getElementById('new_user');
        const existingSection = document.getElementById('existing_user_section');
        const newSection = document.getElementById('new_user_section');

        function toggleSections() {
            if (existingRadio.checked) {
                existingSection.style.display = 'block';
                newSection.style.display = 'none';
            } else {
                existingSection.style.display = 'none';
                newSection.style.display = 'block';
            }
        }

        existingRadio.addEventListener('change', toggleSections);
        newRadio.addEventListener('change', toggleSections);

        // Initialize on page load
        toggleSections();
    });
</script>
@endsection