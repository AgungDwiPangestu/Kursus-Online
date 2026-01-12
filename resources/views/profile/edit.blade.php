@extends('layouts.dashboard')

@section('title', 'Profile - Kursus Online')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h3 class="fw-bold mb-4"><i class="bi bi-person-circle me-2"></i>Profile</h3>

        <!-- Update Profile Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-2">Informasi Profile</h5>
                <p class="text-muted mb-4">Update informasi profile dan alamat email akun Anda.</p>

                @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Profile berhasil diupdate.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-muted small">
                                Alamat email Anda belum diverifikasi.
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link p-0">Klik di sini untuk mengirim ulang email verifikasi.</button>
                            </form>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                            <p class="text-success small mt-2">Link verifikasi baru telah dikirim ke email Anda.</p>
                            @endif
                        </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-gradient">
                        <i class="bi bi-check-lg me-2"></i>Simpan
                    </button>
                </form>
            </div>
        </div>

        <!-- Update Password -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-2">Update Password</h5>
                <p class="text-muted mb-4">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>

                @if (session('status') === 'password-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password berhasil diupdate.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password Baru</label>
                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                        @error('password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-gradient">
                        <i class="bi bi-shield-lock me-2"></i>Update Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card border-0 shadow-sm border-danger">
            <div class="card-body p-4">
                <h5 class="fw-bold text-danger mb-2">Hapus Akun</h5>
                <p class="text-muted mb-4">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.</p>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="bi bi-trash me-2"></i>Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger fw-bold">Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus akun Anda? Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.</p>
                    <p>Silakan masukkan password Anda untuk mengkonfirmasi penghapusan akun.</p>

                    <div class="mt-3">
                        <label for="delete_password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="delete_password" name="password" placeholder="Password" required>
                        @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->userDeletion->isNotEmpty())
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
        modal.show();
    });
</script>
@endsection
@endif
@endsection