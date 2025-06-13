<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'PermataKiddo SIAKAD'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/modern.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <div class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="navbar-brand">PermataKiddo</a>
            <?php if(auth()->guard()->check()): ?>
            <div>
                <span class="nav-text">Selamat datang, <?php echo e(Auth::user()->name); ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="container mt-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success animate-fade-in">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger animate-fade-in">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="mt-4 p-4 text-center text-light" style="background-color:var(--primary-dark)">
        <div class="container">
            <p class="mb-1">&copy; <?php echo e(date('Y')); ?> PermataKiddo SIAKAD</p>
            <p class="mb-0" style="font-size:0.9rem">Sistem Informasi Akademik Sekolah</p>
        </div>
    </footer>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Data\Documents\PK_Final\PermataKiddo\SIAKAD1\resources\views/layouts/app.blade.php ENDPATH**/ ?>