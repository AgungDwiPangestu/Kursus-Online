@extends('layouts.dashboard')

@section('title', 'Dashboard - Kursus Online')

@section('content')
@php
$user = Auth::user();
$isPeserta = !$user->isAdmin() && !$user->isPengajar();
$isPengajar = $user->isPengajar();

if ($isPeserta) {
$myEnrollments = $user->enrollments()->with('kursus.pengajar')->get();
$activeEnrollments = $myEnrollments->where('status', 'active');
$completedEnrollments = $myEnrollments->where('status', 'completed');
$certificates = $completedEnrollments->count();
$allKursus = App\Models\Kursus::with('pengajar')->take(6)->get();
} elseif ($isPengajar && $user->pengajar) {
// Get pengajar's courses and statistics from the passed variable or load directly
if (!isset($myKursus)) {
$myKursus = $user->pengajar->kursus()->with('enrollments.user')->get();
}
$totalKursus = $myKursus->count();
$totalPeserta = $myKursus->sum(function($kursus) {
return $kursus->enrollments->count();
});
$activePeserta = $myKursus->sum(function($kursus) {
return $kursus->enrollments->where('status', 'active')->count();
});
}
@endphp

@if($isPeserta)
<!-- Welcome Banner -->
<div class="welcome-card mb-4">
    <h2 class="display-6 fw-bold mb-2">Selamat datang kembali, {{ $user->name }}! 👋</h2>
    <p class="lead mb-0 opacity-75">Lanjutkan perjalanan belajar Anda hari ini dan raih impian Anda!</p>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card indigo">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 opacity-75">Kursus Aktif</p>
                    <h2 class="display-4 fw-bold mb-0">{{ $activeEnrollments->count() }}</h2>
                    <small class="opacity-75">Sedang berjalan</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-book fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card green">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 opacity-75">Kursus Selesai</p>
                    <h2 class="display-4 fw-bold mb-0">{{ $completedEnrollments->count() }}</h2>
                    <small class="opacity-75">Berhasil diselesaikan</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-check-circle fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card orange">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 opacity-75">Sertifikat</p>
                    <h2 class="display-4 fw-bold mb-0">{{ $certificates }}</h2>
                    <small class="opacity-75">Sertifikat diperoleh</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-award fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if($myEnrollments->count() > 0)
<!-- My Courses -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Kursus Saya</h5>
            <span class="badge bg-primary rounded-pill">{{ $myEnrollments->count() }} kursus</span>
        </div>
    </div>
    <div class="card-body">
        @foreach($myEnrollments as $enrollment)
        @php
        $progress = $enrollment->status == 'completed' ? 100 : rand(20, 85);
        @endphp
        <div class="course-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="fw-bold text-primary mb-1">{{ $enrollment->kursus->nama_kursus }}</h6>
                    <small class="text-muted"><i class="bi bi-person-badge me-1"></i>{{ $enrollment->kursus->pengajar->nama_pengajar }}</small>
                </div>
                <span class="badge {{ $enrollment->status == 'active' ? 'bg-success' : ($enrollment->status == 'completed' ? 'bg-primary' : 'bg-warning') }}">
                    {{ ucfirst($enrollment->status) }}
                </span>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between small mb-1">
                    <span>Progress</span>
                    <span class="fw-bold">{{ $progress }}%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: {{ $progress }}%"></div>
                </div>
            </div>
            <a href="{{ route('kursus.show', $enrollment->kursus) }}" class="btn btn-gradient w-100">
                {{ $progress == 100 ? 'Lihat Sertifikat' : 'Lanjutkan Belajar →' }}
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Course Recommendations -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                {{ $myEnrollments->count() > 0 ? 'Kursus Lainnya untuk Anda' : 'Mulai Perjalanan Belajar Anda' }}
            </h5>
            <a href="{{ route('kursus.index') }}" class="text-decoration-none fw-semibold">Lihat Semua →</a>
        </div>
    </div>
    <div class="card-body">
        @if($allKursus->count() > 0)
        <div class="row g-4">
            @foreach($allKursus->take(6) as $kursus)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm course-card">
                    <div class="card-img-top" style="height: 120px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-book text-white opacity-50" style="font-size: 3rem;"></i>
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold mb-2">{{ $kursus->nama_kursus }}</h6>
                        <p class="small text-muted mb-2"><i class="bi bi-person-badge me-1"></i>{{ $kursus->pengajar->nama_pengajar }}</p>
                        <p class="small text-muted mb-3">{{ Str::limit($kursus->deskripsi, 60) }}</p>
                        <a href="{{ route('kursus.show', $kursus) }}" class="btn btn-gradient btn-sm w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-book text-muted" style="font-size: 4rem;"></i>
            <h5 class="mt-3">Belum ada kursus tersedia</h5>
            <p class="text-muted">Kursus akan segera ditambahkan!</p>
        </div>
        @endif
    </div>
</div>

@elseif($isPengajar && $user->pengajar)
<!-- Pengajar Dashboard -->
<div class="welcome-card mb-4">
    <h2 class="display-6 fw-bold mb-2">Selamat datang, {{ $user->name }}! 👨‍🏫</h2>
    <p class="lead mb-0 opacity-75">Kelola kursus Anda dan pantau perkembangan peserta</p>
</div>

<!-- Pengajar Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card indigo">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 opacity-75">Total Kursus</p>
                    <h2 class="display-4 fw-bold mb-0">{{ $totalKursus }}</h2>
                    <small class="opacity-75">Kursus yang diampu</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-book fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card green">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 opacity-75">Total Peserta</p>
                    <h2 class="display-4 fw-bold mb-0">{{ $totalPeserta }}</h2>
                    <small class="opacity-75">Di semua kursus</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card orange">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 opacity-75">Peserta Aktif</p>
                    <h2 class="display-4 fw-bold mb-0">{{ $activePeserta }}</h2>
                    <small class="opacity-75">Sedang belajar</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-person-check fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- My Courses -->
@if($myKursus->count() > 0)
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Kursus yang Diampu</h5>
            <span class="badge bg-primary rounded-pill">{{ $myKursus->count() }} kursus</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($myKursus as $kursus)
            <div class="col-md-6">
                <div class="course-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-bold text-primary mb-1">{{ $kursus->nama_kursus }}</h6>
                            <small class="text-muted">{{ Str::limit($kursus->deskripsi, 60) }}</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge bg-success">
                            <i class="bi bi-people me-1"></i>{{ $kursus->enrollments->count() }} Peserta
                        </span>
                        <a href="{{ route('kursus.show', $kursus) }}" class="btn btn-sm btn-gradient">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@else
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5">
        <i class="bi bi-book text-muted" style="font-size: 4rem;"></i>
        <h5 class="mt-3">Belum ada kursus</h5>
        <p class="text-muted">Hubungi admin untuk menambahkan kursus yang Anda ampu</p>
    </div>
</div>
@endif

@else
<!-- Admin/Pengajar Dashboard -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h3 class="fw-bold">Selamat datang, {{ $user->name }}!</h3>
        <p class="text-muted mb-0">
            Anda login sebagai
            <span class="fw-semibold text-primary">
                {{ $user->isAdmin() ? 'Administrator' : 'Pengajar' }}
            </span>
        </p>
    </div>
</div>

<!-- Quick Links -->
<div class="row g-4">
    @if($user->isAdmin())
    <div class="col-md-4">
        <a href="{{ route('pengajar.index') }}" class="card border-0 shadow-sm text-decoration-none h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                    <i class="bi bi-person-badge text-primary fs-3"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-dark">Pengajar</h6>
                    <small class="text-muted">Kelola data pengajar</small>
                </div>
            </div>
        </a>
    </div>
    @endif
    <div class="col-md-4">
        <a href="{{ route('kursus.index') }}" class="card border-0 shadow-sm text-decoration-none h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                    <i class="bi bi-book text-success fs-3"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-dark">Kursus</h6>
                    <small class="text-muted">Kelola data kursus</small>
                </div>
            </div>
        </a>
    </div>
    @if($user->isAdmin())
    <div class="col-md-4">
        <a href="{{ route('peserta.index') }}" class="card border-0 shadow-sm text-decoration-none h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                    <i class="bi bi-people text-warning fs-3"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-dark">Peserta</h6>
                    <small class="text-muted">Kelola data peserta</small>
                </div>
            </div>
        </a>
    </div>
    @endif
</div>
@endif
@endsection