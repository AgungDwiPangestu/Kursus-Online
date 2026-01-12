

<?php $__env->startSection('title', 'Detail Peserta - ' . $peserta->nama_peserta); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .detail-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .detail-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
        color: white;
        padding: 40px;
        text-align: center;
    }

    .detail-body {
        padding: 40px;
    }

    .info-item {
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        color: white;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        color: white;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="detail-card">
            <div class="detail-header">
                <div class="mb-3">
                    <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                </div>
                <h3 class="fw-bold mb-2"><?php echo e($peserta->nama_peserta); ?></h3>
                <p class="mb-0 opacity-75"><i class="bi bi-envelope me-2"></i><?php echo e($peserta->email); ?></p>
            </div>
            <div class="detail-body">
                <div class="info-item">
                    <div class="row">
                        <div class="col-4">
                            <strong><i class="bi bi-book me-2"></i>Kursus</strong>
                        </div>
                        <div class="col-8">
                            <?php if($peserta->kursus): ?>
                            <a href="<?php echo e(route('kursus.show', $peserta->kursus)); ?>" class="text-decoration-none">
                                <?php echo e($peserta->kursus->nama_kursus); ?>

                            </a>
                            <?php else: ?>
                            <span class="text-muted">Tidak ada kursus</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="row">
                        <div class="col-4">
                            <strong><i class="bi bi-calendar me-2"></i>Terdaftar</strong>
                        </div>
                        <div class="col-8">
                            <?php echo e($peserta->created_at->format('d F Y, H:i')); ?>

                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="<?php echo e(route('peserta.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                    <a href="<?php echo e(route('peserta.edit', $peserta)); ?>" class="btn btn-gradient">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <form action="<?php echo e(route('peserta.destroy', $peserta)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>Hapus
                        </button>
                    </form>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\UTDI\Semester 5\Teknologi Framework\Pertemuan 14\sistem-manajemen-kursus-online\resources\views/peserta/show.blade.php ENDPATH**/ ?>