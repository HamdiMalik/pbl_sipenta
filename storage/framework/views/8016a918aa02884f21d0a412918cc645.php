<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col">
            <h1 class="mb-4">Edit Data User</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo e(route('users.update', $user->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama User :</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password :</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password :</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="form-group">
                    <label for="level">Peran :</label>
                    <select class="form-control" id="level" name="level">
                        <option value="">Pilih Peran</option>
                        <option value="Admin" <?php echo e(old('level') == 'Admin' ? 'selected' : ''); ?>>Admin</option>
                        <option value="dosen" <?php echo e(old('level') == 'dosen' ? 'selected' : ''); ?>>Dosen</option>
                        <option value="kaprodi" <?php echo e(old('level') == 'kaprodi' ? 'selected' : ''); ?>>Kaprodi</option>
                        <option value="mahasiswa" <?php echo e(old('level') == 'mahasiswa' ? 'selected' : ''); ?>>Mahasiswa</option>
                    </select>
                </div>
                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary mt-3 mb-3">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/pengguna/useredit.blade.php ENDPATH**/ ?>