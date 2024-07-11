<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col">
            <h1 class="mb-4">Detail Data User</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nama User :</label>
                <input type="text" class="form-control" id="name" value="<?php echo e($user->name); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" value="<?php echo e($user->email); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Peran :</label>
                <input type="text" class="form-control" id="level" value="<?php echo e($user->level); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email_verified_at" class="form-label">Email Verified :</label>
                <input type="text" class="form-control" id="email_verified_at"
                    value="<?php echo e($user->email_verified_at ? $user->email_verified_at : 'Not Verified'); ?>" readonly>
            </div>
        </div>
    </div>
    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-primary mt-3 mb-3">Kembali</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/pengguna/usershow.blade.php ENDPATH**/ ?>