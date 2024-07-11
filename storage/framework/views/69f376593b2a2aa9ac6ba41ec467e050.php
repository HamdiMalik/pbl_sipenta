<?php $__env->startSection('main'); ?>
    <div class="card text-center">
        <div class="card-header">
            <h1>Edit Data Dosen</h1>
        </div>
    </div>

    <div class="row py-3">
        <div class="col-md-6">
            <form action="/dosen/<?php echo e($dosen->id); ?>/update" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Dosen :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e($dosen->nama); ?>"
                            required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nip" class="col-sm-4 col-form-label">NIP :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nip" name="nip" value="<?php echo e($dosen->nip); ?>"
                            required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="no_telp" class="col-sm-4 col-form-label">No Telp :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_telp" name="no_telp"
                            value="<?php echo e($dosen->no_telp); ?>" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label">Email :</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo e($dosen->email); ?>"
                            required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="foto" class="col-sm-4 col-form-label">Foto :</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 offset-sm-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?php echo e(url('/dosen')); ?>" class="btn btn-secondary float-end">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/dosenedit.blade.php ENDPATH**/ ?>