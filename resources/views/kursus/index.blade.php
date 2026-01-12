@extends('layouts.public')

@section('title', 'Daftar Kursus')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
        color: white;
        padding: 60px 0;
        margin: -20px -15px 40px -15px;
        border-radius: 0 0 30px 30px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .course-grid-card {
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        background: white;
    }

    .course-grid-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.2);
        border-color: #818cf8;
    }

    .course-grid-header {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
        color: white;
        padding: 30px 25px;
        position: relative;
    }

    .course-grid-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(40%, -40%);
    }
</style>

<div class="page-header">
    <div class="container position-relative" style="z-index: 1;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-2" style="font-size: 2.5rem; text-shadow: 2px 4px 8px rgba(0,0,0,0.2);">📚 Daftar Kursus</h1>
                <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">Pilih kursus terbaik untuk meningkatkan skill Anda</p>
            </div>
            @auth
            @if(auth()->user()->isAdmin())
            <a href="{{ route('kursus.create') }}" class="btn btn-light btn-lg fw-bold" style="border-radius: 15px; padding: 12px 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                <i class="bi bi-plus-circle"></i> Tambah Kursus
            </a>
            @endif
            @endauth
        </div>
    </div>
</div>

<div class="container">
    @if($kursus->count() > 0)
    <div class="row g-4">
        @foreach($kursus as $item)
        <div class="col-md-6 col-lg-4">
            <div class="course-grid-card">
                <div class="course-grid-header">
                    <h3 class="fw-bold mb-2" style="font-size: 1.4rem; position: relative; z-index: 1;">{{ $item->nama_kursus }}</h3>
                    <p class="mb-0" style="opacity: 0.95; position: relative; z-index: 1;">
                        <i class="bi bi-person-badge"></i> {{ $item->pengajar->nama_pengajar }}
                    </p>
                </div>
                <div class="p-4">
                    <p class="text-muted mb-4" style="line-height: 1.6;">{{ Str::limit($item->deskripsi, 120) }}</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('kursus.show', $item) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; font-weight: 600; border-radius: 10px; padding: 8px 20px;">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                        @auth
                        @if(auth()->user()->isPengajar() && auth()->user()->pengajar && $item->pengajar_id == auth()->user()->pengajar->id)
                        <a href="{{ route('kursus.peserta', $item) }}" class="btn btn-sm btn-success fw-semibold" style="border-radius: 10px; padding: 8px 20px;">
                            <i class="bi bi-people"></i> Lihat Peserta
                        </a>
                        @endif
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('kursus.peserta', $item) }}" class="btn btn-sm btn-success fw-semibold" style="border-radius: 10px; padding: 8px 20px;">
                            <i class="bi bi-people"></i> Peserta
                        </a>
                        <a href="{{ route('kursus.edit', $item) }}" class="btn btn-sm btn-warning fw-semibold" style="border-radius: 10px; padding: 8px 20px;">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('kursus.destroy', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger fw-semibold" style="border-radius: 10px; padding: 8px 20px;"
                                onclick="return confirm('Yakin ingin menghapus kursus ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <div style="font-size: 4rem; opacity: 0.3;">📚</div>
        <h3 class="text-muted mt-3">Belum ada data kursus</h3>
    </div>
    @endif
</div>
@endsection