@extends('layouts.public')

@section('title', 'Edit Pengajar')

@section('styles')
<style>
    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        color: white;
        padding: 30px;
    }

    .form-body {
        padding: 40px;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-card">
            <div class="form-header">
                <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Pengajar</h4>
            </div>
            <div class="form-body">
                <form action="{{ route('pengajar.update', $pengajar) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_pengajar" class="form-label">Nama Pengajar</label>
                        <input type="text" class="form-control @error('nama_pengajar') is-invalid @enderror"
                            id="nama_pengajar" name="nama_pengajar"
                            value="{{ old('nama_pengajar', $pengajar->nama_pengajar) }}" required>
                        @error('nama_pengajar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email', $pengajar->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keahlian" class="form-label">Keahlian</label>
                        <input type="text" class="form-control @error('keahlian') is-invalid @enderror"
                            id="keahlian" name="keahlian" value="{{ old('keahlian', $pengajar->keahlian) }}" required>
                        @error('keahlian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gradient">
                            <i class="bi bi-check-lg me-2"></i>Update
                        </button>
                        <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection