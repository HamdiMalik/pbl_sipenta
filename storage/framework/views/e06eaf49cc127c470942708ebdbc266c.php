<?php $__env->startSection('main'); ?>
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Detail Data Ruangan</h1>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID Ruangan</th>
                    <td><?php echo e($ruangan->id); ?></td>
                </tr>
                <tr>
                    <th>Nama Ruangan</th>
                    <td><?php echo e($ruangan->nama); ?></td>
                </tr>
                <tr>
                    <th>Kapasitas</th>
                    <td><?php echo e($ruangan->kapasitas); ?> orang</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo e($ruangan->status); ?></td>
                </tr>
            </tbody>
        </table>
        <a href="<?php echo e(route('ruangan.index')); ?>" class="btn btn-primary">Kembali</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/ruanganshow.blade.php ENDPATH**/ ?>