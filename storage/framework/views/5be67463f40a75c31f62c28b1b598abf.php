<?php $__env->startSection('main'); ?>
    <div>
        <div class="card text-center mb-2">
            <div class="card-header">
                <h1>Tambah Data Ruangan</h1>
            </div>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('ruangan.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="nama">Nama Ruangan:</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Ruangan"
                    required>
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas:</label>
                <input type="number" min="1" name="kapasitas" class="form-control" id="kapasitas"
                    placeholder="Masukkan Kapasitas" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <a href="<?php echo e(route('ruangan.index')); ?>" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/ruangancreate.blade.php ENDPATH**/ ?>