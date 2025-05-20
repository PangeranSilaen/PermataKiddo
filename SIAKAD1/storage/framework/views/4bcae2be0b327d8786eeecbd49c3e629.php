<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua - Permata Kiddo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <div class="header">
            <div>
                <h1>Dashboard Orang Tua</h1>
                <p>Selamat datang, <?php echo e(Auth::user()->name); ?></p>
            </div>
            <div>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-danger">Keluar</button>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="<?php echo e(route('filament.admin.pages.registration')); ?>" class="btn btn-success">Daftarkan Anak</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Data Anak</h5>
                    </div>
                    <div class="card-body">
                        <?php
                            $children = Auth::user()->students ?? [];
                        ?>
                        <?php if(count($children)): ?>
                            <ul class="list-group">
                                <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong><?php echo e($child->name); ?></strong> <br>
                                            NIS: <?php echo e($child->registration_number); ?><br>
                                            Kelas: <?php echo e($child->classRoom->name ?? '-'); ?>

                                        </div>
                                        <div>
                                            <a href="#jadwal-<?php echo e($child->id); ?>" class="btn btn-info btn-sm">Lihat Jadwal</a>
                                            <a href="#tagihan-<?php echo e($child->id); ?>" class="btn btn-warning btn-sm">Lihat Tagihan</a>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p>Belum ada data anak terdaftar.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row" id="tagihan-<?php echo e($child->id); ?>">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">Tagihan SPP - <?php echo e($child->name); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php
                            $bills = $child->payments()->orderByDesc('payment_date')->get();
                        ?>
                        <?php if(count($bills)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                        <td><?php echo e(ucfirst($bill->month)); ?></td>
                                        <td>Rp<?php echo e(number_format($bill->amount,0,',','.')); ?></td>
                                        <td>
                                            <?php if($bill->status == 'paid'): ?>
                                                <span class="badge bg-success">Lunas</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Belum Lunas</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($bill->payment_date ? date('d-m-Y', strtotime($bill->payment_date)) : '-'); ?></td>
                                        <td>
                                            <?php if($bill->status != 'paid'): ?>
                                                <a href="<?php echo e(route('parent.pay', $bill->id)); ?>" class="btn btn-sm btn-primary">Bayar</a>
                                            <?php else: ?>
                                                <span class="text-success">Sudah dibayar</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <p>Tidak ada tagihan SPP.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="jadwal-<?php echo e($child->id); ?>">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Jadwal Kelas - <?php echo e($child->name); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php
                            $schedules = $child->classRoom ? $child->classRoom->schedules()->orderBy('day_of_week')->get() : [];
                        ?>
                        <?php if(count($schedules)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                        <td><?php echo e(__($sch->day_of_week)); ?></td>
                                        <td><?php echo e($sch->subject_name); ?></td>
                                        <td><?php echo e($sch->teacher->name ?? '-'); ?></td>
                                        <td><?php echo e($sch->start_time); ?> - <?php echo e($sch->end_time); ?></td>
                                        <td><?php echo e($sch->room); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <p>Belum ada jadwal untuk kelas ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</body>
</html><?php /**PATH D:\Data\Documents\GitHub\PermataKiddo\SIAKAD1\resources\views/parent/dashboard.blade.php ENDPATH**/ ?>