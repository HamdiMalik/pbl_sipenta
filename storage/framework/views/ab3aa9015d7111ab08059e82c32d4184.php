<?php $__env->startSection('main'); ?>
    <div>
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Detail Penilaian</h1>
            </div>
        </div>

        <table class="table table-bordered">
            <tbody>
                
                <tr>
                    <th scope="row">Judul Tugas Akhir</th>
                    <td><?php echo e($penilaian->tugasAkhir->judul); ?></td>
                </tr>
                <tr>
                    <th scope="row">Dosen Penguji</th>
                    <td><?php echo e($penilaian->dosenPenguji->nama); ?></td>
                </tr>
                <tr>
                    <th scope="row">Total Nilai Akhir</th>
                    <td><?php echo e($penilaian->nilai); ?></td>
                </tr>
                <tr>
                    <th scope="row">Komentar</th>
                    <td><?php echo e($penilaian->komentar); ?></td>
                </tr>
            </tbody>
        </table>

        
        <a href="<?php echo e(route('penilaian.index')); ?>" class="btn btn-primary">Kembali</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/penilaianshow.blade.php ENDPATH**/ ?>