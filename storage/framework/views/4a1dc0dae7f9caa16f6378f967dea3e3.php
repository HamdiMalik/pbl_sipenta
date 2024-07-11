<?php $__env->startSection('main'); ?>
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Detail Data Mahasiswa</h1>
        </div>
    </div>
    <table class="table table-bordered">
        <tbody>
            <?php if($mahasiswa->foto): ?>
                <th style="width:200px;" rowspan="6">
                    <img src="<?php echo e(asset('storage/uploads/' . $mahasiswa->foto)); ?>" alt="<?php echo e($mahasiswa->nama); ?>"
                        style="width:200px;height:300px;">
                </th>
            <?php else: ?>
                <tr>
                    <td rowspan="6" class="center-image">Tidak ada foto</td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>Nama</th>
                <td><?php echo e($mahasiswa->nama); ?></td>
            </tr>
            <tr>
                <th>NIM</th>
                <td><?php echo e($mahasiswa->nim); ?></td>
            </tr>
            <tr>
                <th>Prodi</th>
                <td><?php echo e($mahasiswa->prodi); ?></td>
            </tr>
            <tr>
                <th>Angkatan</th>
                <td><?php echo e($mahasiswa->angkatan); ?></td>
            </tr>
            <tr>
                <th>IPK</th>
                <td><?php echo e($mahasiswa->ipk); ?></td>
            </tr>
        </tbody>
    </table>
    <a href="<?php echo e(route('mahasiswas.index')); ?>" class="btn btn-primary">Kembali</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/mahasiswashow.blade.php ENDPATH**/ ?>