

<?php $__env->startSection('title', 'Detail Capaian Pembelajaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4" style="max-width: 1000px; padding-left: 18px; padding-right: 18px;">
    <form action="<?php echo e(url()->previous()); ?>" method="get" style="display:inline;">
        <button type="submit" class="btn" style="border:1.5px solid #2196f3; color:#2196f3; background:#f8fbff; border-radius:12px; font-weight:600; padding:8px 22px; margin-bottom: 28px; box-shadow:0 1px 4px #e3eafc;">
            <i class="fas fa-arrow-left" style="margin-right:6px;"></i> Kembali
        </button>
    </form>
    <div class="card shadow-sm" style="border-radius: 16px; overflow: hidden; padding: 0 18px 18px 18px; background: #fafdff;">
        <div class="card-header" style="background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%); color: white; border-bottom: 2px solid #e3e3e3; padding: 18px 24px;">
            <h4 class="mb-0" style="font-weight:700; letter-spacing:0.5px;">Detail Laporan Capaian Pembelajaran</h4>
        </div>
        <div class="card-body" style="background: #fafdff; padding: 28px 18px 10px 18px;">
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-secondary">Murid</label>
                    <div class="form-control-plaintext" style="font-size:1.1rem; font-weight:500; padding-left:10px;"><?php echo e($achievement->student->name ?? '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-secondary">Guru</label>
                    <div class="form-control-plaintext" style="font-size:1.1rem; font-weight:500; padding-left:10px;"><?php echo e($achievement->teacher->name ?? '-'); ?></div>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">Capaian</label>
                <div class="row g-3">
                    <?php
                        $capaianArr = is_array($achievement->achievements) ? $achievement->achievements : ($achievement->achievements ? json_decode($achievement->achievements, true) : []);
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $capaianArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $capaian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-12 col-md-6">
                            <div class="card mb-3" style="background: #eaf6ff; border-left: 4px solid #38b6ff; border-radius: 10px; padding: 10px 16px;">
                                <div class="card-body py-2 px-1" style="padding-left:0;">
                                    <span style="font-weight:600; color:#1a4b7a;">Capaian <?php echo e($i+1); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="alert alert-warning mb-0">Tidak ada detail capaian.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold text-secondary">Tanggal Capaian</label>
                    <div class="form-control-plaintext" style="font-size:1rem; padding-left:10px;"><?php echo e($achievement->achievement_date ? \Carbon\Carbon::parse($achievement->achievement_date)->format('d-m-Y') : '-'); ?></div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold text-secondary">Semester</label>
                    <div class="form-control-plaintext" style="font-size:1rem; padding-left:10px;">
                        <?php if($achievement->semester == '1'): ?> Semester 1 <?php elseif($achievement->semester == '2'): ?> Semester 2 <?php else: ?> - <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold text-secondary">Tahun Ajaran</label>
                    <div class="form-control-plaintext" style="font-size:1rem; padding-left:10px;"><?php echo e($achievement->academic_year); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Data\Documents\GitHub\PermataKiddo\SIAKAD1\resources\views/parent/achievement-detail.blade.php ENDPATH**/ ?>