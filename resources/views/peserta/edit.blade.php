@extends('layouts.public')

@section('title', 'Edit Peserta')

@section('styles')
<style>
    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
        color: white;
        padding: 30px;
    }

    .form-body {
        padding: 40px;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-card">
            <div class="form-header">
                <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Peserta</h4>
            </div>
            <div class="form-body">
                <form action="{{ route('peserta.update', $peserta) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kursus_id" class="form-label fw-semibold">Kursus</label>
                        <select class="form-select @error('kursus_id') is-invalid @enderror"
                            id="kursus_id" name="kursus_id" required>
                            <option value="">Pilih Kursus</option>
                            @foreach($kursus as $k)
                            <option value="{{ $k->id }}"
                                {{ old('kursus_id', $peserta->kursus_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kursus }}
                            </option>
                            @endforeach
                        </select>
                        @error('kursus_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_peserta" class="form-label fw-semibold">Nama Peserta</label>
                        <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror"
                            id="nama_peserta" name="nama_peserta"
                            value="{{ old('nama_peserta', $peserta->nama_peserta) }}" required>
                        @error('nama_peserta')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email', $peserta->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gradient">
                            <i class="bi bi-check-lg me-2"></i>Update
                        </button>
                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection