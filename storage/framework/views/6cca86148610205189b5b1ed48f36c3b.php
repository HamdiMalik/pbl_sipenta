<?php $__env->startSection('main'); ?>
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Users</h1>
        </div>
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <div class="row py-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <div>
                    <form action="<?php echo e(route('users.import')); ?>" method="POST" enctype="multipart/form-data" class="d-inline">
                        <?php echo csrf_field(); ?>

                        <button for="file" class="btn btn-success mb-2" type="submit"><i class="fa fa-file">
                                Import</i></button>
                        <a class="btn btn-warning mb-2" href="/exportuser">
                            <i class="fa fa-download"> Ekspor</i>
                        </a>

                        <input type="file" name="file" id="file" class="form-control mb-2" accept=".xlsx">
                    </form>
                </div>
            </div>

            <div id="datatable_info" class="mr-2"></div>

            <div class="col-auto">
                <div>
                    <label>
                        Show
                        <select name="entries" id="entries" class="form-select form-select-sm d-inline-block"
                            style="width: auto; display: inline;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entries
                    </label>
                    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary ml-3">Tambah User</a>
                </div>
                

                
                
                

                
                

            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if($users->count() > 0): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                        <td class="align-middle"><?php echo e($user->name); ?></td>
                        <td class="align-middle"><?php echo e($user->email); ?></td>
                        <td class="align-middle"><?php echo e($user->level); ?></td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                
                                <a href="<?php echo e(route('users.show', $user->id)); ?>" class="btn btn-info mr-1">Detail</a>
                                
                                <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-warning mr-1">Edit</a>
                                <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger mr-1">Delete</button>
                                </form>
                                
                                
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/pengguna/users.blade.php ENDPATH**/ ?>