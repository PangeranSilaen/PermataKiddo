<?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginald09a0ea6d62fc9155b01d885c3fdffb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald09a0ea6d62fc9155b01d885c3fdffb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.form.index','data' => ['wire:submit' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:submit' => 'submit']); ?>
        <?php echo e($this->form); ?>

        <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['type' => 'submit','class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'mt-4']); ?>
            Kirim Pendaftaran
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald09a0ea6d62fc9155b01d885c3fdffb3)): ?>
<?php $attributes = $__attributesOriginald09a0ea6d62fc9155b01d885c3fdffb3; ?>
<?php unset($__attributesOriginald09a0ea6d62fc9155b01d885c3fdffb3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald09a0ea6d62fc9155b01d885c3fdffb3)): ?>
<?php $component = $__componentOriginald09a0ea6d62fc9155b01d885c3fdffb3; ?>
<?php unset($__componentOriginald09a0ea6d62fc9155b01d885c3fdffb3); ?>
<?php endif; ?>

    <!--[if BLOCK]><![endif]--><?php if(auth()->user() && auth()->user()->hasRole('parent') && isset($bills)): ?>
        <div class="card mt-4">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Tagihan SPP Anak</h5>
            </div>
            <div class="card-body">
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaAnak => $tagihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <h6><?php echo e($namaAnak); ?></h6>
                    <!--[if BLOCK]><![endif]--><?php if(count($tagihan)): ?>
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
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(ucfirst($bill->month)); ?></td>
                                    <td>Rp<?php echo e(number_format($bill->amount,0,',','.')); ?></td>
                                    <td>
                                        <!--[if BLOCK]><![endif]--><?php if($bill->status == 'paid'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Belum Lunas</span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>
                                    <td><?php echo e($bill->payment_date ? date('d-m-Y', strtotime($bill->payment_date)) : '-'); ?></td>
                                    <td>
                                        <!--[if BLOCK]><![endif]--><?php if($bill->status != 'paid'): ?>
                                            <a href="<?php echo e(route('parent.pay', $bill->id)); ?>" class="btn btn-sm btn-primary">Bayar</a>
                                        <?php else: ?>
                                            <span class="text-success">Sudah dibayar</span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Tidak ada tagihan SPP.</p>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Belum ada data anak terdaftar.</p>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="mt-8 text-center text-sm text-gray-500">
        <p>Setelah mengirimkan pendaftaran, admin akan mereview dan memproses data Anda.</p>
        <p>Harap tunggu konfirmasi dari kami melalui email atau telepon yang Anda daftarkan.</p>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php /**PATH D:\Data\Documents\GitHub\PermataKiddo\SIAKAD1\resources\views/filament/pages/registration.blade.php ENDPATH**/ ?>