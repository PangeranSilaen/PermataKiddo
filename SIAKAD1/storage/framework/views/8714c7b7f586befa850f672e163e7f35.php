<?php $__env->startSection('title', 'Pembayaran SPP - PermataKiddo'); ?>

<?php $__env->startSection('content'); ?>
<div class="header">
    <div>
        <h1>Pembayaran SPP</h1>
        <p>Konfirmasi pembayaran tagihan bulanan</p>
    </div>
    <div>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline btn-outline-primary">
            <i class="fas fa-arrow-left btn-icon"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card animate-fade-in">
            <div class="card-header primary">
                <h5 class="mb-0"><i class="fas fa-info-circle btn-icon"></i>Detail Tagihan</h5>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="table">
                        <tr>
                            <th style="width: 35%">Bulan</th>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="payment-status-indicator <?php echo e($payment->status == 'paid' ? 'payment-status-paid' : 'payment-status-pending'); ?>"></span>
                                    <?php echo e(ucfirst($payment->month)); ?>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td class="fw-bold">Rp<?php echo e(number_format($payment->amount,0,',','.')); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if($payment->status == 'paid'): ?>
                                    <span class="badge badge-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Belum Lunas</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pembayaran</th>
                            <td><?php echo e($payment->payment_date ? date('d-m-Y', strtotime($payment->payment_date)) : '-'); ?></td>
                        </tr>
                        <?php if($payment->payment_method): ?>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>
                                <?php
                                    $methods = [
                                        'cash' => 'Tunai',
                                        'credit_card' => 'Kartu Kredit',
                                        'bank_transfer' => 'Transfer Bank',
                                        'e_wallet' => 'E-Wallet',
                                        'other' => 'Lainnya'
                                    ];
                                ?>
                                <?php echo e($methods[$payment->payment_method] ?? $payment->payment_method); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if($payment->payment_proof): ?>
                        <tr>
                            <th>Bukti Pembayaran</th>
                            <td>
                                <a href="<?php echo e(Storage::url($payment->payment_proof)); ?>" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fas fa-image btn-icon"></i>Lihat Bukti
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <?php if($payment->status != 'paid'): ?>
        <div class="card animate-fade-in" style="animation-delay: 0.2s">
            <div class="card-header warning">
                <h5 class="mb-0"><i class="fas fa-money-bill-wave btn-icon"></i>Konfirmasi Pembayaran</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('parent.pay.confirm', $payment->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" class="form-select" required onchange="toggleProof(this.value)">
                            <option value="">Pilih Metode</option>
                            <option value="cash">Tunai</option>
                            <option value="credit_card">Kartu Kredit</option>
                            <option value="bank_transfer">Transfer Bank</option>
                            <option value="e_wallet">E-Wallet</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group" id="proof-upload" style="display:none;">
                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                        <div class="d-flex flex-column">
                            <div class="file-upload-wrapper" style="position: relative;">
                                <label for="payment_proof" style="display: block; padding: 2rem; border: 2px dashed var(--text-lighter); border-radius: var(--border-radius); text-align: center; cursor: pointer; transition: all var(--transition-speed);">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: var(--primary-color); margin-bottom: 0.5rem;"></i><br>
                                    <span id="file-name">Klik atau seret file ke sini</span>
                                </label>
                                <input type="file" name="payment_proof" id="payment_proof" accept="image/*" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onchange="updateFileName(this)">
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-light); margin-top: var(--spacing-xs);">
                                Format: JPG, PNG (maks. 2MB)
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="amount" value="<?php echo e($payment->amount); ?>">
                    <button type="submit" class="btn btn-success w-100 mt-3">
                        <i class="fas fa-check-circle btn-icon"></i>Konfirmasi Bayar
                    </button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div class="card animate-fade-in" style="animation-delay: 0.2s">
            <div class="card-header success">
                <h5 class="mb-0"><i class="fas fa-check-circle btn-icon"></i>Status Pembayaran</h5>
            </div>
            <div class="card-body text-center p-4">
                <div style="font-size: 5rem; color: var(--success-color); margin-bottom: var(--spacing-lg);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="mb-2">Pembayaran Berhasil</h4>
                <p style="color: var(--text-light);">Tagihan untuk bulan <?php echo e(ucfirst($payment->month)); ?> telah lunas.</p>
                <a href="<?php echo e(route('parent.dashboard')); ?>" class="btn btn-primary mt-3">
                    <i class="fas fa-home btn-icon"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
        <?php endif; ?>

        <div class="card animate-fade-in mt-3" style="animation-delay: 0.3s">
            <div class="card-header info">
                <h5 class="mb-0"><i class="fas fa-info-circle btn-icon"></i>Informasi</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <div style="color: var(--primary-color); margin-right: 10px; margin-top: 3px;"><i class="fas fa-info-circle"></i></div>
                    <div>
                        <p class="mb-0">Pembayaran tunai bisa dilakukan langsung ke bagian keuangan sekolah.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <div style="color: var(--primary-color); margin-right: 10px; margin-top: 3px;"><i class="fas fa-credit-card"></i></div>
                    <div>
                        <p class="mb-0">Pembayaran non tunai memerlukan bukti pembayaran.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div style="color: var(--primary-color); margin-right: 10px; margin-top: 3px;"><i class="fas fa-clock"></i></div>
                    <div>
                        <p class="mb-0">Konfirmasi pembayaran diproses dalam 1x24 jam pada hari kerja.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
function toggleProof(val) {
    document.getElementById('proof-upload').style.display = (val !== 'cash' && val !== '') ? 'block' : 'none';
    document.getElementById('payment_proof').required = (val !== 'cash' && val !== '');
}

function updateFileName(input) {
    const fileName = input.files[0]?.name || 'Klik atau seret file ke sini';
    document.getElementById('file-name').textContent = fileName;
}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Data\Documents\PK_Final\PermataKiddo\SIAKAD1\resources\views/parent/pay.blade.php ENDPATH**/ ?>