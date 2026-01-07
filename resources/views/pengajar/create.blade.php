@extends('layouts.app')

@section('title', 'Tambah Pengajar')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Pengajar Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pengajar.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_pengajar" class="form-label">Nama Pengajar</label>
                        <input type="text" class="form-control @error('nama_pengajar') is-invalid @enderror"
                            id="nama_pengajar" name="nama_pengajar" value="{{ old('nama_pengajar') }}" required>
                        @error('nama_pengajar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keahlian" class="form-label">Keahlian</label>
                        <input type="text" class="form-control @error('keahlian') is-invalid @enderror"
                            id="keahlian" name="keahlian" value="{{ old('keahlian') }}" required>
                        @error('keahlian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection