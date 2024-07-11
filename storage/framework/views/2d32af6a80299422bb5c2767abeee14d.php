<?php $__env->startSection('main'); ?>
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Penilaian</h1>
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

            <div class="col-auto">
                <a href="<?php echo e(route('penilaian.create')); ?>" class="btn btn-primary">Buat Penilaian Baru</a>
            </div>
            
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Judul Tugas Akhir</th>
                <th>Dosen Penguji</th>
                <th>Nilai</th>
                <th>Komentar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $penilaians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penilaian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                    <td class="align-middle"><?php echo e($penilaian->tugasAkhir->judul); ?></td>
                    <td class="align-middle"><?php echo e($penilaian->dosenPenguji->nama); ?></td>
                    <td class="align-middle"><?php echo e($penilaian->nilai); ?></td>
                    <td class="align-middle"><?php echo e($penilaian->komentar); ?></td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="<?php echo e(route('penilaian.show', $penilaian->id)); ?>" class="btn btn-info mr-1">Detail</a>
                            <a href="<?php echo e(route('penilaian.edit', $penilaian->id)); ?>" class="btn btn-warning mr-1">Edit</a>
                            <form action="<?php echo e(route('penilaian.destroy', $penilaian->id)); ?>" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus penilaian?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data penilaian</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/pages/penilaian.blade.php ENDPATH**/ ?>