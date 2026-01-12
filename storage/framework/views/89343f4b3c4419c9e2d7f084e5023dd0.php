

<?php $__env->startSection('title', 'Detail Kursus'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .course-header {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 25px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);
    }

    .course-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(40%, -40%);
    }

    .course-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
    }

    .course-meta {
        display: flex;
        gap: 30px;
        align-items: center;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.15);
        padding: 10px 20px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .course-content {
        padding: 0;
    }

    .info-card {
        background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 25px;
        border: 2px solid #e5e7eb;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border-color: #c7d2fe;
    }

    .info-label {
        font-weight: 700;
        color: #6366f1;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .info-value {
        font-size: 1.2rem;
        color: #1f2937;
        font-weight: 600;
        line-height: 1.6;
    }

    .instructor-card {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 30px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 20px;
        margin-bottom: 25px;
        box-shadow: 0 15px 30px rgba(99, 102, 241, 0.3);
        color: white;
    }

    .instructor-avatar {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border: 3px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        font-weight: 800;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .enrollment-card {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 40px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
        margin-bottom: 25px;
    }

    .peserta-list {
        list-style: none;
        padding: 0;
    }

    .peserta-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: linear-gradient(to right, #f9fafb 0%, #ffffff 100%);
        border-radius: 15px;
        margin-bottom: 12px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s;
    }

    .peserta-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-color: #c7d2fe;
    }

    .peserta-avatar {
        width: 50px;
        height: 50px;
        background: #667eea;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .btn-group-custom {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
</style>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="course-header">
                <h1 class="course-title"><?php echo e($kursus->nama_kursus); ?></h1>
                <div class="course-meta">
                    <div class="meta-item">
                        <i class="bi bi-person-badge"></i>
                        <span><?php echo e($kursus->pengajar->nama_pengajar); ?></span>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-people-fill"></i>
                        <span><?php echo e($kursus->peserta->count()); ?> Peserta</span>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-clock"></i>
                        <span><?php echo e($kursus->durasi ?? '8 Minggu'); ?></span>
                    </div>
                </div>
            </div>

            <div class="course-content">
                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-card-text"></i> Deskripsi Kursus
                    </div>
                    <div class="info-value">
                        <?php echo e($kursus->deskripsi); ?>

                    </div>
                </div>

                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-lightbulb"></i> Apa yang akan dipelajari
                    </div>
                    <div class="info-value">
                        <ul>
                            <?php
                            // Generate learning points based on course name
                            $learningPoints = [
                            'Laravel' => [
                            'Membangun aplikasi web dengan Laravel Framework',
                            'Implementasi MVC Pattern dan Eloquent ORM',
                            'Authentication dan Authorization',
                            'RESTful API Development'
                            ],
                            'Node.js' => [
                            'Server-side JavaScript dengan Node.js',
                            'Express.js untuk web framework',
                            'Database integration dengan MongoDB',
                            'Real-time applications dengan Socket.io'
                            ],
                            'React' => [
                            'Fundamental React dan JSX',
                            'Component-based architecture',
                            'State Management dengan Redux',
                            'React Hooks dan modern patterns'
                            ],
                            'Vue' => [
                            'Vue.js basics dan directives',
                            'Component composition dan reusability',
                            'Vuex untuk state management',
                            'Vue Router untuk navigation'
                            ],
                            'Docker' => [
                            'Container fundamentals dan Docker architecture',
                            'Docker images dan Dockerfile',
                            'Docker Compose untuk multi-container apps',
                            'Container orchestration basics'
                            ],
                            'AWS' => [
                            'AWS core services (EC2, S3, RDS)',
                            'Cloud infrastructure deployment',
                            'Security dan IAM management',
                            'Monitoring dan cost optimization'
                            ],
                            'Flutter' => [
                            'Flutter framework dan Dart programming',
                            'Building cross-platform mobile apps',
                            'State management dengan Provider',
                            'API integration dan local storage'
                            ],
                            'Python' => [
                            'Python fundamentals dan syntax',
                            'Data structures dan algorithms',
                            'Object-oriented programming',
                            'Working dengan libraries dan frameworks'
                            ]
                            ];

                            $points = [];
                            foreach ($learningPoints as $key => $value) {
                            if (stripos($kursus->nama_kursus, $key) !== false) {
                            $points = $value;
                            break;
                            }
                            }

                            if (empty($points)) {
                            $points = [
                            'Fundamental concepts dan best practices',
                            'Hands-on projects dan real-world applications',
                            'Problem solving dan debugging skills',
                            'Industry-standard tools dan workflows'
                            ];
                            }
                            ?>

                            <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($point); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

                <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isAdmin()): ?>
                <div class="btn-group-custom">
                    <a href="<?php echo e(route('kursus.edit', $kursus)); ?>" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Kursus
                    </a>
                    <form action="<?php echo e(route('kursus.destroy', $kursus)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus kursus ini?')">
                            <i class="bi bi-trash"></i> Hapus Kursus
                        </button>
                    </form>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <a href="<?php echo e(route('kursus.index')); ?>" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kursus
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Enrollment Card -->
        <?php
        $isEnrolled = false;
        if (Auth::check()) {
        $isEnrolled = $kursus->enrollments()->where('user_id', Auth::id())->exists();
        }
        ?>

        <div class="card shadow-sm mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="card-body text-center">
                <h5 class="card-title fw-bold mb-3">
                    <?php if($isEnrolled): ?>
                    <i class="bi bi-check-circle-fill"></i> Anda Terdaftar
                    <?php else: ?>
                    <i class="bi bi-mortarboard"></i> Daftar Sekarang
                    <?php endif; ?>
                </h5>

                <?php if($isEnrolled): ?>
                <div class="alert alert-light mb-3">
                    <i class="bi bi-info-circle"></i> Anda sudah terdaftar di kursus ini
                </div>
                <p class="mb-0 small">Mulai belajar dan tingkatkan skill Anda!</p>
                <?php else: ?>
                <p class="mb-4">Bergabunglah dengan <?php echo e($kursus->enrolledUsers->count()); ?> peserta lainnya</p>

                <?php if(auth()->guard()->check()): ?>
                <?php if(!auth()->user()->isAdmin()): ?>
                <form action="<?php echo e(route('kursus.enroll', $kursus)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-light btn-lg w-100 fw-bold">
                        <i class="bi bi-check-circle"></i> Daftar Kursus
                    </button>
                </form>
                <?php else: ?>
                <p class="small mb-0"><i class="bi bi-shield-check"></i> Anda login sebagai Admin</p>
                <?php endif; ?>
                <?php else: ?>
                <form action="<?php echo e(route('login')); ?>" method="GET">
                    <input type="hidden" name="intended" value="<?php echo e(route('kursus.show', $kursus)); ?>">
                    <button type="submit" class="btn btn-light btn-lg w-100 fw-bold">
                        <i class="bi bi-box-arrow-in-right"></i> Login untuk Mendaftar
                    </button>
                </form>
                <small class="d-block mt-2">Belum punya akun? <a href="<?php echo e(route('register')); ?>" class="text-white fw-bold">Daftar disini</a></small>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Instructor Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-person-badge"></i> Instruktur
                </h5>
                <div class="instructor-card">
                    <div class="instructor-avatar">
                        <?php echo e(strtoupper(substr($kursus->pengajar->nama_pengajar, 0, 1))); ?>

                    </div>
                    <div>
                        <h6 class="mb-1"><?php echo e($kursus->pengajar->nama_pengajar); ?></h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            <i class="bi bi-award"></i> <?php echo e($kursus->pengajar->keahlian); ?>

                        </p>
                        <small class="text-muted">
                            <i class="bi bi-envelope"></i> <?php echo e($kursus->pengajar->email); ?>

                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peserta List -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-people-fill"></i> Daftar Peserta (<?php echo e($kursus->enrolledUsers->count()); ?>)
                </h5>

                <?php if($kursus->enrolledUsers->count() > 0): ?>
                <ul class="peserta-list">
                    <?php $__currentLoopData = $kursus->enrolledUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="peserta-item">
                        <div class="peserta-avatar">
                            <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                        </div>
                        <div>
                            <h6 class="mb-0" style="font-size: 0.95rem;"><?php echo e($user->name); ?></h6>
                            <small class="text-muted"><?php echo e($user->email); ?></small>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php else: ?>
                <div class="text-center text-muted py-4">
                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                    <p class="mt-2">Belum ada peserta yang terdaftar</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\UTDI\Semester 5\Teknologi Framework\Pertemuan 14\sistem-manajemen-kursus-online\resources\views/kursus/show.blade.php ENDPATH**/ ?>