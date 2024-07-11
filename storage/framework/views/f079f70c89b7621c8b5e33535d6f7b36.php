<?php $__env->startSection('main'); ?>
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Laporan Data Sidang</h1>
        </div>
    </div>
    <table class="table table-bordered border-primary">
        <tbody>
            <?php if($sidang->tugasAkhir): ?>
                <tr>
                    <th>Judul Tugas Akhir:</th>
                    <td><?php echo e($sidang->tugasAkhir->judul); ?></td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa:</th>
                    <td><?php echo e($sidang->tugasAkhir->mahasiswa->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Dosen Pembimbing 1:</th>
                    <td><?php echo e($sidang->tugasAkhir->pembimbing_1->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Dosen Pembimbing 2:</th>
                    <td><?php echo e($sidang->tugasAkhir->pembimbing_2->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <?php if($sidang->penilaians->isNotEmpty()): ?>
                    <tr>
                        <th>Dosen Penguji</th>
                        <td><?php echo e($sidang->penilaians->first()->dosenPenguji->nama); ?></td>
                    </tr>
                    <tr>
                        <th>Nilai Akhir</th>
                        <td><?php echo e($sidang->penilaians->first()->nilai); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <th colspan="2">Data penilaian tidak tersedia.</th>
                    </tr>
                <?php endif; ?>




                
            <?php endif; ?>
            <?php if($sidang): ?>
                <tr>
                    <th>Tanggal:</th>
                    <td><?php echo e(date_format(date_create($sidang->tanggal), 'd-M-Y')); ?></td>
                </tr>
                <tr>
                    <th>Ruangan:</th>
                    <td><?php echo e($sidang->ruangan->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Sesi:</th>
                    <td><?php echo e($sidang->sesi); ?></td>
                </tr>
                <tr>
                    <th>Ketua Sidang:</th>
                    <td><?php echo e($sidang->ketua->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Sekretaris Sidang:</th>
                    <td><?php echo e($sidang->sekretaris->nama ?? 'Tidak ada data'); ?></td>
                </tr>
                <tr>
                    <th>Anggota:</th>
                    <td><?php echo e($sidang->anggota); ?></td>
                </tr>
                <tr>
                    <th>Status Kelulusan:</th>
                    <td><?php echo e($sidang->status_kelulusan); ?></td>
                </tr>
            <?php endif; ?>


        </tbody>
    </table>
    <button class="btn btn-success mt-3 mb-3" onclick="window.print()">Cetak Berita Acara Sidang</button>
    <a href="<?php echo e(route('sidang.index')); ?>" class="btn btn-primary mt-3 mb-3">Kembali</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/sidangshow.blade.php ENDPATH**/ ?>