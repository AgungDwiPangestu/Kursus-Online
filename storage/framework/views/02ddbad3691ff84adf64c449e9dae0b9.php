

<?php $__env->startSection('title', 'Detail Pengajar'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pengajar</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin() || auth()->user()->isPengajar()): ?>
                    <tr>
                        <th width="200">ID</th>
                        <td><?php echo e($pengajar->id); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php endif; ?>
                    <tr>
                        <th>Nama Pengajar</th>
                        <td><?php echo e($pengajar->nama_pengajar); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo e($pengajar->email); ?></td>
                    </tr>
                    <tr>
                        <th>Keahlian</th>
                        <td><?php echo e($pengajar->keahlian); ?></td>
                    </tr>
                </table>

                <div class="mt-3">
                    <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('pengajar.edit', $pengajar)); ?>" class="btn btn-warning">Edit</a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <a href="<?php echo e(route('pengajar.index')); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Daftar Kursus yang Diajar</h5>
            </div>
            <div class="card-body">
                <?php if($pengajar->kursus->count() > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Kursus</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pengajar->kursus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kursus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($kursus->nama_kursus); ?></td>
                            <td><?php echo e($kursus->deskripsi); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-muted">Belum ada kursus yang diajar</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\UTDI\Semester 5\Teknologi Framework\Pertemuan 14\sistem-manajemen-kursus-online\resources\views/pengajar/show.blade.php ENDPATH**/ ?>