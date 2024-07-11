<?php $__env->startSection('main'); ?>
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Detail Data Dosen</h1>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <?php if($dosen->foto): ?>
                    <tr>
                        <td style="width:200px;" rowspan="5">
                            <img src="<?php echo e(asset('storage/uploads/' . $dosen->foto)); ?>" alt="<?php echo e($dosen->nama); ?>"
                                style="width:200px;height:300px;">
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th>NIP</th>
                    <td><?php echo e($dosen->nip); ?></td>
                </tr>
                <tr>
                    <th>Nama Dosen</th>
                    <td><?php echo e($dosen->nama); ?></td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td><?php echo e($dosen->no_telp); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo e($dosen->email); ?></td>
                </tr>
            </tbody>
        </table>
        <a href="<?php echo e(route('dosen.index')); ?>" class="btn btn-primary mb-3">Kembali</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/dosenshow.blade.php ENDPATH**/ ?>