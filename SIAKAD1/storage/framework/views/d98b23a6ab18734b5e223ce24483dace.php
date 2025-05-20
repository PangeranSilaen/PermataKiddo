

<?php $__env->startSection('title', 'Pendaftaran Anak - PermataKiddo'); ?>

<?php $__env->startSection('content'); ?>
<div class="header">
    <div>
        <h1>Pendaftaran Anak</h1>
        <p>Lengkapi form pendaftaran anak dengan data yang benar</p>
    </div>
    <div>
        <a href="<?php echo e(route('parent.dashboard')); ?>" class="btn btn-outline btn-outline-primary">
            <i class="fas fa-arrow-left btn-icon"></i>Kembali
        </a>
    </div>
</div>

<div class="card animate-fade-in">
    <div class="card-header primary">
        <h5 class="mb-0"><i class="fas fa-child btn-icon"></i>Form Pendaftaran</h5>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('parent.register.submit')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap Anak</label>
                        <input type="text" name="name" id="name" class="form-control" required maxlength="255" value="<?php echo e(old('name')); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="birth_date" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control" required value="<?php echo e(old('birth_date')); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male" <?php if(old('gender')=='male'): ?> selected <?php endif; ?>>Laki-laki</option>
                            <option value="female" <?php if(old('gender')=='female'): ?> selected <?php endif; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="photo" class="form-label">Foto Anak</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        <div style="font-size: 0.8rem; color: var(--text-light); margin-top: var(--spacing-xs);">
                            Format: JPG, PNG, atau GIF (maks. 2MB)
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Alamat</label>
                <textarea name="address" id="address" class="form-control" required><?php echo e(old('address')); ?></textarea>
            </div>

            <hr class="mt-4 mb-4">
            <h5 class="mb-3"><i class="fas fa-user-friends text-primary mr-2"></i>Informasi Orang Tua/Wali</h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent_name" class="form-label">Nama Orang Tua/Wali</label>
                        <input type="text" name="parent_name" id="parent_name" class="form-control" required maxlength="255" value="<?php echo e(old('parent_name', auth()->user()->name)); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent_phone" class="form-label">Nomor Telepon Orang Tua</label>
                        <div class="d-flex">
                            <div style="background: var(--text-lighter); display: flex; align-items: center; padding: 0 var(--spacing-md); border-radius: var(--border-radius) 0 0 var(--border-radius); border: 1px solid var(--text-lighter); border-right: none;">
                                <i class="fas fa-phone"></i>
                            </div>
                            <input type="text" name="parent_phone" id="parent_phone" class="form-control" required maxlength="20" value="<?php echo e(old('parent_phone')); ?>" style="border-radius: 0 var(--border-radius) var(--border-radius) 0;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="parent_email" class="form-label">Email Orang Tua</label>
                <div class="d-flex">
                    <div style="background: var(--text-lighter); display: flex; align-items: center; padding: 0 var(--spacing-md); border-radius: var(--border-radius) 0 0 var(--border-radius); border: 1px solid var(--text-lighter); border-right: none;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="parent_email" id="parent_email" class="form-control" maxlength="255" value="<?php echo e(old('parent_email', auth()->user()->email)); ?>" style="border-radius: 0 var(--border-radius) var(--border-radius) 0;">
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="<?php echo e(route('parent.dashboard')); ?>" class="btn btn-outline btn-outline-primary">
                    <i class="fas fa-arrow-left btn-icon"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane btn-icon"></i>Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Data\Documents\GitHub\PermataKiddo\SIAKAD1\resources\views/parent/register.blade.php ENDPATH**/ ?>