<?php $__env->startSection('main'); ?>
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Detail Data Tugas Akhir</h1>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Judul:</th>
                    <td><?php echo e($tugasAkhir->judul); ?></td>
                </tr>
                <tr>
                    <th>Mahasiswa</th>
                    <td><?php echo e($tugasAkhir->mahasiswa->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Pembimbing 1</th>
                    <td><?php echo e($tugasAkhir->pembimbing_1->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Pembimbing 2</th>
                    <td><?php echo e($tugasAkhir->pembimbing_2->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Laporan PKL</th>
                    
                    <td><a href="<?php echo e(Storage::url($tugasAkhir->dokumen_laporan_pkl)); ?>" target="_blank">Lihat dan download
                            dokumen</a>
                    </td>
                </tr>
                <tr>
                    <th>Dokumen Lembar Pembimbing:</th>
                    
                    <td><a href="<?php echo e(Storage::url($tugasAkhir->dokumen_lembar_pembimbing)); ?>" target="_blank">Lihat dan
                            download dokumen</a>
                    </td>
                </tr>
                <tr>
                    <th>Proposal Tugas Tugas Akhir:</th>
                    
                    <td><a href="<?php echo e(Storage::url($tugasAkhir->dokumen_proposal_tugas_akhir)); ?>" target="_blank">Lihat dan
                            download dokumen</a>
                    </td>
                </tr>
                <tr>
                    <th>Laporan Tugas Akhir:</th>
                    
                    <td><a href="<?php echo e(Storage::url($tugasAkhir->dokumen_laporan_tugas_akhir)); ?>" target="_blank">Lihat dan
                            download dokumen</a>
                    </td>
                </tr>
                <tr>
                    <th>Status Validasi Pembimbing:</th>
                    <td><?php echo e($tugasAkhir->validasi_pembimbing ? 'Sudah Validasi' : 'Belum Validasi'); ?></td>
                </tr>
                <tr>
                    <th>Status Validasi Penguji:</th>
                    <td><?php echo e($tugasAkhir->validasi_penguji ? 'Sudah Validasi' : 'Belum Validasi'); ?></td>
                </tr>
            </tbody>

        </table>
        <form action="<?php echo e(route('tugas_akhirs.validasi', $tugasAkhir)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="role">Jabatan Sidang</label>
                <select name="role" id="role" class="form-control">
                    <option value="pembimbing">Pembimbing</option>
                    <option value="penguji">Penguji</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Validasi Dokumen</button>
            <a href="<?php echo e(route('tugas_akhirs.index')); ?>" class="btn btn-primary">Kembali</a>
        </form>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/tugas_akhirshow.blade.php ENDPATH**/ ?>