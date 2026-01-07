@extends('layouts.public')

@section('title', 'Detail Pengajar')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pengajar</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isPengajar())
                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $pengajar->id }}</td>
                    </tr>
                    @endif
                    @endauth
                    <tr>
                        <th>Nama Pengajar</th>
                        <td>{{ $pengajar->nama_pengajar }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pengajar->email }}</td>
                    </tr>
                    <tr>
                        <th>Keahlian</th>
                        <td>{{ $pengajar->keahlian }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('pengajar.edit', $pengajar) }}" class="btn btn-warning">Edit</a>
                    @endif
                    @endauth
                    <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Daftar Kursus yang Diajar</h5>
            </div>
            <div class="card-body">
                @if($pengajar->kursus->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Kursus</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajar->kursus as $kursus)
                        <tr>
                            <td>{{ $kursus->nama_kursus }}</td>
                            <td>{{ $kursus->deskripsi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-muted">Belum ada kursus yang diajar</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection