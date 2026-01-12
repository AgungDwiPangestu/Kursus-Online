<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Kursus Online'); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
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

        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
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

    <!-- Content -->
    <div class="container py-4">
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\ASUS\Documents\UTDI\Semester 5\Teknologi Framework\Pertemuan 14\sistem-manajemen-kursus-online\resources\views/layouts/public.blade.php ENDPATH**/ ?>