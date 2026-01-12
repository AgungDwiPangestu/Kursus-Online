@extends('layouts.public')

@section('title', 'Peserta Kursus - ' . $kursus->nama_kursus)

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

    .student-card {
        border: 2px solid #e5e7eb;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .student-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.15);
        border-color: #818cf8;
    }

    .student-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .status-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .status-completed {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
    }

    .status-inactive {
        background: #e5e7eb;
        color: #6b7280;
    }

    .stats-card {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 30px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .stat-label {
        opacity: 0.9;
        font-size: 0.9rem;
    }
</style>

<div class="page-header">
    <div class="container position-relative" style="z-index: 1;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <a href="{{ route('kursus.index') }}" class="btn btn-sm btn-light mb-3" style="border-radius: 10px;">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kursus
                </a>
                <h1 class="fw-bold mb-2" style="font-size: 2rem; text-shadow: 2px 4px 8px rgba(0,0,0,0.2);">
                    👥 Peserta Kursus
                </h1>
                <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">
                    <i class="bi bi-book"></i> {{ $kursus->nama_kursus }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Statistics -->
    <div class="stats-card">
        <div class="row">
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number">{{ $kursus->enrollments->count() }}</div>
                    <div class="stat-label"><i class="bi bi-people"></i> Total Peserta</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number">{{ $kursus->enrollments->where('status', 'active')->count() }}</div>
                    <div class="stat-label"><i class="bi bi-person-check"></i> Peserta Aktif</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number">{{ $kursus->enrollments->where('status', 'completed')->count() }}</div>
                    <div class="stat-label"><i class="bi bi-award"></i> Selesai</div>
                </div>
            </div>
        </div>
    </div>

    @if($kursus->enrollments->count() > 0)
    <div class="row g-4">
        @foreach($kursus->enrollments as $enrollment)
        <div class="col-md-6 col-lg-4">
            <div class="student-card p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="student-avatar me-3">
                        {{ strtoupper(substr($enrollment->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1 fw-bold">{{ $enrollment->user->name ?? 'Unknown User' }}</h5>
                        <p class="mb-0 text-muted small">
                            <i class="bi bi-envelope"></i> {{ $enrollment->user->email ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="border-top pt-3 mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">
                            <i class="bi bi-calendar-event"></i> Tanggal Daftar
                        </span>
                        <span class="fw-semibold small">
                            {{ $enrollment->tanggal_daftar ? \Carbon\Carbon::parse($enrollment->tanggal_daftar)->format('d M Y') : '-' }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">
                            <i class="bi bi-flag"></i> Status
                        </span>
                        @if($enrollment->status == 'active')
                        <span class="status-badge status-active">
                            <i class="bi bi-play-circle"></i> Aktif
                        </span>
                        @elseif($enrollment->status == 'completed')
                        <span class="status-badge status-completed">
                            <i class="bi bi-check-circle"></i> Selesai
                        </span>
                        @else
                        <span class="status-badge status-inactive">
                            <i class="bi bi-pause-circle"></i> {{ ucfirst($enrollment->status) }}
                        </span>
                        @endif
                    </div>
                    @if($enrollment->tanggal_selesai)
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="text-muted small">
                            <i class="bi bi-calendar-check"></i> Tanggal Selesai
                        </span>
                        <span class="fw-semibold small text-success">
                            {{ \Carbon\Carbon::parse($enrollment->tanggal_selesai)->format('d M Y') }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <div style="font-size: 4rem; opacity: 0.3;">👥</div>
        <h3 class="text-muted mt-3">Belum ada peserta terdaftar</h3>
        <p class="text-muted">Peserta yang mendaftar kursus ini akan muncul di sini</p>
    </div>
    @endif
</div>
@endsection