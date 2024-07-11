<?php $__env->startSection('main'); ?>
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Ruangan</h1>
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
        <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center mt-3">
                <label class="mr-3 d-flex align-items-center">
                    Search:
                    <input type="search" id="search" class="form-control form-control-sm d-inline-block ml-2"
                        placeholder="" style="width: auto;">
                </label>
                <label class="d-flex align-items-center mx-5">
                    Show
                    <select name="entries" id="entries" class="form-select form-select-sm d-inline-block ml-2"
                        style="width: auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ml-2">entries</span>
                </label>
            </div>
            <div class="col-auto mt-2">
                
                <a href="<?php echo e(route('ruangan.create')); ?>" class="btn btn-primary ml-3">Tambah Ruangan</a>
                
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Ruangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if($ruangan->count() > 0): ?>
                <?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                        <td class="align-middle"><?php echo e($ruangan->id); ?></td>
                        <td class="align-middle"><?php echo e($ruangan->nama); ?></td>
                        <td class="align-middle"><?php echo e($ruangan->status); ?></td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo e(route('ruangan.show', $ruangan)); ?>" class="btn btn-info mr-1">Detail</a>
                                <a href="<?php echo e(route('ruangan.edit', $ruangan->id)); ?>" class="btn btn-warning mr-1">Edit</a>
                                <form action="<?php echo e(route('ruangan.destroy', $ruangan->id)); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td class="align-middle text-center" colspan="6">Ruangan tidak ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/pages/ruangan.blade.php ENDPATH**/ ?>