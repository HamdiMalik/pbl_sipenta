<?php $__env->startSection('main'); ?>
    <div class="card text-center mb-2">
        <div class="card-header">
            <h1>Edit Data Ruangan</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo e(route('ruangan.update', $ruangan->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label for="nama">Nama Ruangan:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e($ruangan->nama); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="kapasitas">Kapasitas:</label>
                    <input type="number" min="1" class="form-control" id="kapasitas" name="kapasitas"
                        value="<?php echo e($ruangan->kapasitas); ?>" required>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="tersedia" <?php echo e($ruangan->status == 'tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                        <option value="tidak tersedia" <?php echo e($ruangan->status == 'tidak tersedia' ? 'selected' : ''); ?>>Tidak
                            Tersedia</option>
                    </select>
                </div>
                <a href="<?php echo e(route('ruangan.index')); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/ruanganedit.blade.php ENDPATH**/ ?>