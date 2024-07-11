<?php $__env->startSection('main'); ?>
    <div class="card text-center mb-2">
        <div class="card-header">
            <h1>Buat Pengajuan Tugas Akhir</h1>
        </div>
    </div>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Tugas Akhir</title>
    </head>

    <body>
        <?php if($errors->any()): ?>
            <div>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('tugas_akhirs.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" class="form-control" value="<?php echo e(old('judul')); ?>">
            </div>

            <div class="form-group">
                <label for="mahasiswa">Mahasiswa:</label>
                <?php if($datamahasiswa): ?>
                    <input type="hidden" value="<?php echo e($datamahasiswa->nama); ?>" name="mahasiswa">
                    <input type="text" value="<?php echo e($datamahasiswa->nama); ?>" class="form-control" disabled>
                <?php else: ?>
                    <select name="mahasiswa" id="mahasiswa" class="form-control">
                        <option value="">Pilih Mahasiswa</option>
                        <?php $__currentLoopData = $mahasiswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($mahasiswa->nama); ?>"><?php echo e($mahasiswa->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="pembimbing1">Pembimbing 1:</label>
                <select name="pembimbing1" id="pembimbing1" class="form-control">
                    <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dosen->nama); ?>"><?php echo e($dosen->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pembimbing2">Pembimbing 2:</label>
                <select name="pembimbing2" id="pembimbing2" class="form-control">
                    <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dosen->nama); ?>"><?php echo e($dosen->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="dokumen_laporan_pkl">Laporan PKL</label>
                <input type="file" name="dokumen_laporan_pkl" id="dokumen_laporan_pkl" class="form-control">
            </div>
            <div class="form-group">
                <label for="dokumen_lembar_pembimbing">Dokumen Pembimbing</label>
                <input type="file" name="dokumen_lembar_pembimbing" id="dokumen_lembar_pembimbing" class="form-control">
            </div>
            <div class="form-group">
                <label for="dokumen_proposal_tugas_akhir">Proposal Tugas Akhir</label>
                <input type="file" name="dokumen_proposal_tugas_akhir" id="dokumen_proposal_tugas_akhir"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="dokumen_laporan_tugas_akhir">Laporan Tugas Akhir</label>
                <input type="file" name="dokumen_laporan_tugas_akhir" id="dokumen_laporan_tugas_akhir"
                    class="form-control">
            </div>


            
            <a href="<?php echo e(route('tugas_akhirs.index')); ?>" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>

    </html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/tugas_akhircreate.blade.php ENDPATH**/ ?>