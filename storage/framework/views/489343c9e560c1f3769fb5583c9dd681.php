<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kursus Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f3f4f6;
            padding-top: 80px;
        }

        .navbar-custom {
            background: white !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: #4f46e5 !important;
            font-size: 1.5rem;
        }

        .nav-link-custom {
            color: #4b5563 !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link-custom:hover {
            color: #4f46e5 !important;
        }

        .btn-register {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            color: white !important;
            padding: 10px 24px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6b21a8 100%);
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #1e1b4b 100%);
            color: white;
            padding: 100px 0 80px;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 30px 30px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: translate(40%, -40%);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 25px;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.4rem;
            opacity: 0.95;
            margin-bottom: 40px;
            font-weight: 500;
        }

        .course-card {
            border: 2px solid #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            background: linear-gradient(to bottom, #ffffff 0%, #faf5ff 100%);
        }

        .course-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.2);
            border-color: #818cf8;
        }

        .course-header {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            color: white;
            padding: 30px;
        }

        .course-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .course-body {
            padding: 30px;
        }

        .badge-category {
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            color: #4f46e5;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 700;
            border: 1px solid #c7d2fe;
        }

        .stats-section {
            background: linear-gradient(135deg, #f9fafb 0%, #f3e8ff 100%);
            padding: 70px 0;
            margin-top: 60px;
        }

        .stat-item {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .stat-item:hover {
            transform: translateY(-10px);
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #6b7280;
            font-size: 1.1rem;
            margin-top: 10px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-mortarboard-fill"></i> Kursus Online
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="<?php echo e(route('pengajar.index')); ?>">
                            <i class="bi bi-person-badge"></i> Pengajar
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="<?php echo e(route('kursus.index')); ?>">
                            <i class="bi bi-book"></i> Kursus
                        </a>
                    </li>
                    <?php if(Auth::user()->isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="<?php echo e(route('peserta.index')); ?>">
                            <i class="bi bi-people"></i> Peserta
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="<?php echo e(route('dashboard')); ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?php echo e(Auth::user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="<?php echo e(route('login')); ?>">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-register" href="<?php echo e(route('register')); ?>">
                            <i class="bi bi-person-plus"></i> Daftar
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="hero-title">🚀 Tingkatkan Skill Anda</h1>
            <p class="hero-subtitle">Pilih dari berbagai kursus programming yang disesuaikan dengan kebutuhan Anda</p>
            <a href="<?php echo e(route('kursus.index')); ?>" class="btn btn-light btn-lg px-5 py-3 fw-bold" style="border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);">
                <i class="bi bi-search"></i> Jelajahi Semua Kursus
            </a>
        </div>
    </div>

    <!-- Courses Section -->
    <div class="container mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="font-size: 2.5rem; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">📚 Kursus Populer Kami</h2>
            <p class="text-muted" style="font-size: 1.1rem; font-weight: 500;">Pelajari teknologi terkini dari instruktur berpengalaman</p>
        </div>

        <?php if($kursus->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $kursus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="card course-card">
                    <div class="course-header">
                        <h3 class="course-title"><?php echo e($item->nama_kursus); ?></h3>
                        <div class="instructor-info">
                            <i class="bi bi-person-circle"></i> <?php echo e($item->pengajar->nama_pengajar); ?>

                        </div>
                    </div>
                    <div class="course-body">
                        <p class="text-muted mb-3"><?php echo e(Str::limit($item->deskripsi, 150)); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge-category">
                                <i class="bi bi-tag-fill"></i> <?php echo e($item->pengajar->keahlian); ?>

                            </span>
                            <a href="<?php echo e(route('kursus.show', $item)); ?>" class="btn btn-sm btn-primary" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: none; border-radius: 10px;">
                                Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Belum ada kursus tersedia.
            <br><br>
            <code>php artisan db:seed --class=KursusSeeder</code>
        </div>
        <?php endif; ?>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2.5rem; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">✨ Statistik Platform</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-item">
                        <i class="bi bi-book-fill" style="font-size: 3rem; color: #4f46e5;"></i>
                        <div class="stat-number"><?php echo e($kursus->count()); ?></div>
                        <div class="stat-label">Kursus Tersedia</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <i class="bi bi-people-fill" style="font-size: 3rem; color: #10b981;"></i>
                        <div class="stat-number"><?php echo e($kursus->pluck('pengajar_id')->unique()->count()); ?></div>
                        <div class="stat-label">Pengajar Ahli</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <i class="bi bi-person-check-fill" style="font-size: 3rem; color: #f59e0b;"></i>
                        <div class="stat-number"><?php echo e($kursus->sum(function($k) { return $k->peserta->count(); })); ?></div>
                        <div class="stat-label">Peserta Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 Sistem Manajemen Kursus Online. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH C:\Users\ASUS\Documents\UTDI\Semester 5\Teknologi Framework\Pertemuan 14\sistem-manajemen-kursus-online\resources\views/welcome.blade.php ENDPATH**/ ?>