
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Bayar Tagihan SPP</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>Bulan</th><td><?php echo e(ucfirst($payment->month)); ?></td></tr>
                <tr><th>Nominal</th><td>Rp<?php echo e(number_format($payment->amount,0,',','.')); ?></td></tr>
                <tr><th>Status</th><td><?php echo $payment->status == 'paid' ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-danger">Belum Lunas</span>'; ?></td></tr>
                <tr><th>Tanggal Bayar</th><td><?php echo e($payment->payment_date ? date('d-m-Y', strtotime($payment->payment_date)) : '-'); ?></td></tr>
            </table>
            <?php if($payment->status != 'paid'): ?>
                <form method="POST" action="<?php echo e(route('parent.pay.confirm', $payment->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
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
                    <div class="mb-3" id="proof-upload" style="display:none;">
                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept="image/*">
                        <div class="form-text">Wajib diisi jika bukan pembayaran tunai.</div>
                    </div>
                    <input type="hidden" name="amount" value="<?php echo e($payment->amount); ?>">
                    <button type="submit" class="btn btn-success">Konfirmasi Bayar</button>
                </form>
                <script>
                function toggleProof(val) {
                    document.getElementById('proof-upload').style.display = (val !== 'cash' && val !== '') ? 'block' : 'none';
                    document.getElementById('payment_proof').required = (val !== 'cash' && val !== '');
                }
                </script>
            <?php else: ?>
                <div class="alert alert-success mt-3">Tagihan sudah dibayar.</div>
            <?php endif; ?>
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Data\Documents\GitHub\PermataKiddo\SIAKAD1\resources\views/parent/pay.blade.php ENDPATH**/ ?>