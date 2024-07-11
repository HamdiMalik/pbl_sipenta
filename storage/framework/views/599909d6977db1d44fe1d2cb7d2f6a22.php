<?php $__env->startSection('main'); ?>

    <div class="card text-center">
        <div class="card-header">
            <h1>Data Mahasiswa</h1>
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
    </div>
    <div class="row py-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            
            <div>
                <form action="<?php echo e(route('mahasiswas.import')); ?>" method="POST" enctype="multipart/form-data" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-success mb-2"><i class="fa fa-file"> Import</i></button>
                    <a class="btn btn-warning mb-2" href="/exportmahasiswa">
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
                        
                        <a href="<?php echo e(route('mahasiswas.create')); ?>" class="btn btn-primary ml-3">Tambah Mahasiswa</a>
                        
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>IPK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($mahasiswas->count() > 0): ?>
                    <?php $__currentLoopData = $mahasiswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                            <td class="align-middle"><?php echo e($mahasiswa->nama); ?></td>
                            <td class="align-middle"><?php echo e($mahasiswa->nim); ?></td>
                            <td class="align-middle"><?php echo e($mahasiswa->prodi); ?></td>
                            <td class="align-middle"><?php echo e($mahasiswa->angkatan); ?></td>
                            <td class="align-middle"><?php echo e($mahasiswa->ipk); ?></td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?php echo e(route('mahasiswa.show', $mahasiswa)); ?>"
                                        class="btn btn-info mr-1">Detail</a>
                                    <a href="<?php echo e(route('mahasiswas.edit', $mahasiswa->id)); ?>"
                                        class="btn btn-warning mr-1">Edit</a>
                                    <form action="<?php echo e(route('mahasiswas.destroy', $mahasiswa->id)); ?>" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete?')">
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
                        <td class="align-middle text-center" colspan="6">Mahasiswa tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/pages/mahasiswas.blade.php ENDPATH**/ ?>