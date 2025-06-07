<?php $__env->startSection('title', 'Dashboard Orang Tua - PermataKiddo'); ?>

<?php $__env->startSection('content'); ?>
<div class="header">
    <div>
        <h1>Dashboard Orang Tua</h1>
        <p>Kelola informasi akademik anak Anda dengan mudah</p>
    </div>
    <div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline btn-outline-danger">
                <i class="fas fa-sign-out-alt btn-icon"></i>Keluar
            </button>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card animate-fade-in">
            <div class="card-body text-center">
                <i class="fas fa-user-graduate" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: var(--spacing-md);"></i>
                <h3><?php echo e(Auth::user()->students->count()); ?></h3>
                <p class="text-light">Jumlah Anak Terdaftar</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card animate-fade-in" style="animation-delay: 0.1s;">
            <div class="card-body text-center">
                <i class="fas fa-calendar-alt" style="font-size: 2.5rem; color: var(--primary-light); margin-bottom: var(--spacing-md);"></i>
                <h3><?php echo e(date('d M Y')); ?></h3>
                <p class="text-light">Tanggal Hari Ini</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card animate-fade-in" style="animation-delay: 0.2s;">
            <div class="card-body text-center">
                <i class="fas fa-clipboard-list" style="font-size: 2.5rem; color: var(--accent-color); margin-bottom: var(--spacing-md);"></i>
                <h3><?php echo e(\App\Models\Registration::where('user_id', Auth::id())->count()); ?></h3>
                <p class="text-light">Pendaftaran</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <a href="<?php echo e(route('parent.register')); ?>" class="btn btn-primary">
            <i class="fas fa-plus-circle btn-icon"></i>Daftarkan Anak
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header primary">
        <h5 class="mb-0">Data Anak</h5>
    </div>
    <div class="card-body">
        <?php
            $children = Auth::user()->students ?? [];
        ?>
        <?php if(count($children)): ?>
            <div class="list-group">
                <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="student-info">
                            <?php if($child->photo): ?>
                                <img src="<?php echo e(Storage::url($child->photo)); ?>" alt="<?php echo e($child->name); ?>" class="student-avatar">
                            <?php else: ?>
                                <div class="student-avatar" style="background-color: var(--primary-light); display: flex; justify-content: center; align-items: center; color: white;">
                                    <?php echo e(strtoupper(substr($child->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?>
                            <div class="student-details">
                                <div class="student-name"><?php echo e($child->name); ?></div>
                                <div class="mb-1">
                                    <span class="badge" style="background-color:var(--text-light); color:white;">NIS: <?php echo e($child->registration_number); ?></span>
                                    <span class="badge" style="background-color:var(--primary-dark); color:white;"><?php echo e($child->classRoom->name ?? 'Belum memiliki kelas'); ?></span>
                                </div>
                                <div style="font-size: 0.9rem; color: var(--text-light);">
                                    <i class="fas fa-venus-mars" style="color: var(--primary-light);"></i> 
                                    <?php echo e($child->gender == 'male' ? 'Laki-laki' : 'Perempuan'); ?>

                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="#jadwal-<?php echo e($child->id); ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-calendar btn-icon"></i>Jadwal
                            </a>
                            <a href="#tagihan-<?php echo e($child->id); ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-credit-card btn-icon"></i>Tagihan
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center p-4">
                <i class="fas fa-child" style="font-size: 3rem; color: var(--text-lighter); margin-bottom: var(--spacing-md);"></i>
                <p>Belum ada data anak terdaftar.</p>
                <p class="text-light">Silakan klik tombol "Daftarkan Anak" untuk menambahkan data anak</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id="tagihan-<?php echo e($child->id); ?>" class="card mb-4 animate-fade-in">
    <div class="card-header warning">
        <h5 class="mb-0"><i class="fas fa-credit-card btn-icon"></i>Tagihan SPP - <?php echo e($child->name); ?></h5>
    </div>
    <div class="card-body">
        <?php
            $bills = $child->payments()->orderByDesc('payment_date')->get();
        ?>
        <?php if(count($bills)): ?>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Tanggal Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="payment-status-indicator <?php echo e($bill->status == 'paid' ? 'payment-status-paid' : 'payment-status-pending'); ?>"></span>
                                <?php echo e(ucfirst($bill->month)); ?>

                            </div>
                        </td>
                        <td>Rp<?php echo e(number_format($bill->amount,0,',','.')); ?></td>
                        <td>
                            <?php if($bill->status == 'paid'): ?>
                                <span class="badge badge-success">Lunas</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Belum Lunas</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($bill->payment_date ? date('d-m-Y', strtotime($bill->payment_date)) : '-'); ?></td>
                        <td>
                            <?php if($bill->status != 'paid'): ?>
                                <a href="<?php echo e(route('parent.pay', $bill->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-money-bill-wave btn-icon"></i>Bayar
                                </a>
                            <?php else: ?>
                                <span class="text-success"><i class="fas fa-check-circle"></i> Sudah dibayar</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="text-center p-4">
                <i class="fas fa-receipt" style="font-size: 3rem; color: var(--text-lighter); margin-bottom: var(--spacing-md);"></i>
                <p>Tidak ada tagihan SPP.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div id="jadwal-<?php echo e($child->id); ?>" class="card mb-4 animate-fade-in">
    <div class="card-header info">
        <h5 class="mb-0"><i class="fas fa-calendar-alt btn-icon"></i>Jadwal Kelas - <?php echo e($child->name); ?></h5>
    </div>
    <div class="card-body">
        <?php
            $schedules = $child->classRoom ? $child->classRoom->schedules()->orderBy('day_of_week')->get() : [];
        ?>
        <?php if(count($schedules)): ?>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <span class="schedule-day"><?php echo e(__($sch->day_of_week)); ?></span>
                        </td>
                        <td><?php echo e($sch->subject_name); ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div style="width: 30px; height: 30px; border-radius: 50%; background-color: var(--primary-light); color: white; display: flex; justify-content: center; align-items: center; margin-right: 8px;">
                                    <?php echo e(strtoupper(substr($sch->teacher->name ?? 'G', 0, 1))); ?>

                                </div>
                                <?php echo e($sch->teacher->name ?? '-'); ?>

                            </div>
                        </td>
                        <td>
                            <i class="far fa-clock" style="color: var(--primary-color);"></i>
                            <?php echo e(\Carbon\Carbon::parse($sch->start_time)->format('H:i')); ?> - <?php echo e(\Carbon\Carbon::parse($sch->end_time)->format('H:i')); ?>

                        </td>
                        <td>
                            <i class="fas fa-door-open" style="color: var(--text-light);"></i>
                            <?php echo e($sch->room); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="text-center p-4">
                <i class="fas fa-calendar-times" style="font-size: 3rem; color: var(--text-lighter); margin-bottom: var(--spacing-md);"></i>
                <p>Belum ada jadwal untuk kelas ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card mb-4 animate-fade-in">
    <div class="card-header success">
        <h5 class="mb-0"><i class="fas fa-trophy btn-icon"></i>Laporan Capaian Pembelajaran - <?php echo e($child->name); ?></h5>
    </div>
    <div class="card-body">
        <?php
            $achievements = $child->achievements()->orderByDesc('achievement_date')->get();
        ?>
        <?php if(count($achievements)): ?>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Jumlah Capaian</th>
                        <th>Detail Capaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($ach->achievement_date ? \Carbon\Carbon::parse($ach->achievement_date)->format('d-m-Y') : '-'); ?></td>
                        <td><?php echo e($ach->semester); ?></td>
                        <td><?php echo e($ach->academic_year); ?></td>
                        <td>
                            <?php
                                $capaianArr = is_array($ach->achievements) ? $ach->achievements : ($ach->achievements ? json_decode($ach->achievements, true) : []);
                            ?>
                            <?php echo e(count($capaianArr)); ?> capaian
                        </td>
                        <td>
                            <a href="<?php echo e(route('parent.achievement.detail', $ach->id)); ?>" class="btn btn-sm btn-info">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="text-center p-4">
                <i class="fas fa-trophy" style="font-size: 3rem; color: var(--text-lighter); margin-bottom: var(--spacing-md);"></i>
                <p>Belum ada laporan capaian pembelajaran.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Data\Documents\GitHub\PermataKiddo\SIAKAD1\resources\views/parent/dashboard.blade.php ENDPATH**/ ?>