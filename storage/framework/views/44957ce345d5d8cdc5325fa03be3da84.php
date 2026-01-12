

<?php $__env->startSection('title', 'Daftar Pengajar'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .page-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
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

    .instructor-card {
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .instructor-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.2);
        border-color: #34d399;
    }

    .instructor-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        padding: 40px 30px;
        text-align: center;
        position: relative;
    }

    .instructor-avatar {
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
                <h1 class="fw-bold mb-2" style="font-size: 2.5rem; text-shadow: 2px 4px 8px rgba(0,0,0,0.2);">👨‍🏫 Daftar Pengajar</h1>
                <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">Instruktur berpengalaman siap membimbing Anda</p>
            </div>
            <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->isAdmin()): ?>
            <a href="<?php echo e(route('pengajar.create')); ?>" class="btn btn-light btn-lg fw-bold" style="border-radius: 15px; padding: 12px 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                <i class="bi bi-plus-circle"></i> Tambah Pengajar
            </a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <?php if($pengajars->count() > 0): ?>
    <div class="row g-4">
        <?php $__currentLoopData = $pengajars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengajar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4">
            <div class="instructor-card">
                <div class="instructor-header">
                    <div class="instructor-avatar">
                        <?php echo e(strtoupper(substr($pengajar->nama_pengajar, 0, 1))); ?>

                    </div>
                    <h3 class="fw-bold text-white mb-1" style="font-size: 1.4rem;"><?php echo e($pengajar->nama_pengajar); ?></h3>
                    <p class="text-white mb-0" style="opacity: 0.9;">
                        <i class="bi bi-award"></i> <?php echo e($pengajar->keahlian); ?>

                    </p>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <div class="text-muted small mb-1">EMAIL</div>
                        <div class="fw-semibold"><i class="bi bi-envelope"></i> <?php echo e($pengajar->email); ?></div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="<?php echo e(route('pengajar.show', $pengajar)); ?>" class="btn btn-sm" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; font-weight: 600; border-radius: 10px; padding: 8px 20px;">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                        <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('pengajar.edit', $pengajar)); ?>" class="btn btn-sm btn-warning fw-semibold" style="border-radius: 10px; padding: 8px 20px;">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="<?php echo e(route('pengajar.destroy', $pengajar)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger fw-semibold" style="border-radius: 10px; padding: 8px 20px;"
                                onclick="return confirm('Yakin ingin menghapus pengajar ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <div class="text-center py-5">
        <div style="font-size: 4rem; opacity: 0.3;">👨‍🏫</div>
        <h3 class="text-muted mt-3">Belum ada data pengajar</h3>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\UTDI\Semester 5\Teknologi Framework\Pertemuan 14\sistem-manajemen-kursus-online\resources\views/pengajar/index.blade.php ENDPATH**/ ?>