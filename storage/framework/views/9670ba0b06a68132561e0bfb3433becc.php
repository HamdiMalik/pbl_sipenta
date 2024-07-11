<?php $__env->startSection('main'); ?>
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Dosen</h1>
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
    <div class="row py-2">
        <div class="col-md-12 d-flex justify-content-between align-items-center">

            

            <div>
                <form action="<?php echo e(route('dosens.import')); ?>" method="POST" enctype="multipart/form-data" class="d-inline">
                    <?php echo csrf_field(); ?>

                    <button class="btn btn-success mb-2"><i class="fa fa-file"> Import</i></button>
                    <a class="btn btn-warning mb-2" href="/exportdosen">
                        <i class="fa fa-download"> Ekspor</i>
                    </a>
                    <input type="file" name="file" class="form-control mb-2">
                </form>


            </div>

            <div id="datatable_info" class="mr-3"></div>

            <div>
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

                        
                        <a href="<?php echo e(route('dosen.create')); ?>" class="btn btn-primary ml-3">Tambah Dosen</a>
                        
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($dosens->count() > 0): ?>
                    <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                            <td class="align-middle"><?php echo e($dosen->nip); ?></td>
                            <td class="align-middle"><?php echo e($dosen->nama); ?></td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?php echo e(route('dosen.show', $dosen)); ?>" class="btn btn-info mr-1">Detail</a>
                                    <a href="<?php echo e(route('dosen.edit', $dosen)); ?>" class="btn btn-warning mr-1">Edit</a>
                                    <form action="<?php echo e(route('dosen.destroy', $dosen->id)); ?>" method="POST" class="d-inline"
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
                        <td class="align-middle text-center" colspan="8">Dosen tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Kuliah\Kuliah\PBL\pbl_sipenta\resources\views/pages/dosen.blade.php ENDPATH**/ ?>