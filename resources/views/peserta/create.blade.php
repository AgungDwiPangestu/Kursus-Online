@extends('layouts.app')

@section('title', 'Tambah Peserta')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Peserta Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="kursus_id" class="form-label">Kursus</label>
                        <select class="form-select @error('kursus_id') is-invalid @enderror"
                            id="kursus_id" name="kursus_id" required>
                            <option value="">Pilih Kursus</option>
                            @foreach($kursus as $item)
                            <option value="{{ $item->id }}" {{ old('kursus_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kursus }}
                            </option>
                            @endforeach
                        </select>
                        @error('kursus_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_peserta" class="form-label">Nama Peserta</label>
                        <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror"
                            id="nama_peserta" name="nama_peserta" value="{{ old('nama_peserta') }}" required>
                        @error('nama_peserta')
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

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection