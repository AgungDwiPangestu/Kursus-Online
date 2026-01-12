@extends('layouts.public')

@section('title', 'Daftar Peserta')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
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

    .student-card {
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .student-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(245, 158, 11, 0.2);
        border-color: #fbbf24;
    }

    .student-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        padding: 40px 30px;
        text-align: center;
        position: relative;
    }

    .student-avatar {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border: 4px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin: 0 auto 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="page-header">
    <div class="container position-relative" style="z-index: 1;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-2" style="font-size: 2.5rem; text-shadow: 2px 4px 8px rgba(0,0,0,0.2);">👥 Daftar Peserta</h1>
                <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">Siswa yang terdaftar dalam kursus</p>
            </div>
            @auth
            @if(auth()->user()->isAdmin())
            <a href="{{ route('peserta.create') }}" class="btn btn-light btn-lg fw-bold" style="border-radius: 15px; padding: 12px 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                <i class="bi bi-plus-circle"></i> Tambah Peserta
            </a>
            @endif
            @endauth
        </div>
    </div>
</div>

<div class="container">
    @if($pesertas->count() > 0)
    <div class="row g-4">
        @foreach($pesertas as $peserta)
        <div class="col-md-6 col-lg-4">
            <div class="student-card">
                <div class="student-header">
                    <div class="student-avatar">
                        {{ strtoupper(substr($peserta['nama_peserta'], 0, 1)) }}
                    </div>
                    <h3 class="fw-bold text-white mb-1" style="font-size: 1.4rem;">{{ $peserta['nama_peserta'] }}</h3>
                </div>
                <div class="p-4">
                    <div class="mb-3">
                        <div class="text-muted small mb-1">EMAIL</div>
                        <div class="fw-semibold"><i class="bi bi-envelope"></i> {{ $peserta['email'] }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small mb-1">KURSUS DIIKUTI</div>
                        <div class="badge bg-primary rounded-pill mb-2">{{ $peserta['kursus_list']->count() }} Kursus</div>
                        @if($peserta['kursus_list']->count() > 0)
                        <div class="mt-2">
                            @foreach($peserta['kursus_list'] as $kursus)
                            <div class="d-flex align-items-center mb-2 p-2" style="background: #f3f4f6; border-radius: 8px;">
                                <i class="bi bi-book-fill text-primary me-2"></i>
                                <span class="small">{{ $kursus->nama_kursus }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-muted small">Tidak ada kursus</div>
                        @endif
                    </div>
                    @auth
                    @if(auth()->user()->isAdmin())
                    <div class="d-flex gap-2 flex-wrap mt-3">
                        <button type="button" class="btn btn-sm btn-danger fw-semibold" style="border-radius: 10px; padding: 8px 20px;"
                            onclick="deleteAllEnrollments('{{ $peserta['email'] }}', {{ json_encode($peserta['peserta_ids']) }})">
                            <i class="bi bi-trash"></i> Hapus Semua
                        </button>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <div style="font-size: 4rem; opacity: 0.3;">👥</div>
        <h3 class="text-muted mt-3">Belum ada data peserta</h3>
        <p class="text-muted">Peserta akan muncul setelah user mendaftar kursus</p>
    </div>
    @endif
</div>

@auth
@if(auth()->user()->isAdmin())
<form id="deleteAllForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function deleteAllEnrollments(email, pesertaIds) {
        if (!confirm(`Yakin ingin menghapus semua pendaftaran kursus untuk ${email}?`)) {
            return;
        }

        const form = document.getElementById('deleteAllForm');
        form.action = '{{ route("peserta.index") }}/delete-all';

        // Add peserta IDs as hidden inputs
        pesertaIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'peserta_ids[]';
            input.value = id;
            form.appendChild(input);
        });

        form.submit();
    }
</script>
@endif
@endauth
@endsection