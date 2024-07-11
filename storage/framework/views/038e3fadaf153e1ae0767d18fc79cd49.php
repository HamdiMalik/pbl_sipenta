<?php $__env->startSection('main'); ?>
    <div class="card text-center mb-2">
        <div class="card-header">
            <h1>Edit Data Tugas Akhir</h1>
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
    <div>
        <form action="<?php echo e(route('tugas_akhirs.update', $tugasAkhir->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" class="form-control"
                    value="<?php echo e(old('judul', $tugasAkhir->judul)); ?>">
            </div>
            <div class="form-group">
                <label for="mahasiswa">Mahasiswa:</label>
                <select name="mahasiswa" id="mahasiswa" class="form-control">
                    <option value="">Pilih Mahasiswa</option>
                    <?php $__currentLoopData = $mahasiswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mahasiswa->id); ?>"
                            <?php echo e($mahasiswa->id == $tugasAkhir->mahasiswa_id ? 'selected' : ''); ?>>
                            <?php echo e($mahasiswa->nama); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pembimbing1">Pembimbing 1:</label>
                <select name="pembimbing1" id="pembimbing1" class="form-control">
                    <option value="">Pilih Dosen</option>
                    <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dosen->id); ?>" <?php echo e($dosen->id == $tugasAkhir->pembimbing1 ? 'selected' : ''); ?>>
                            <?php echo e($dosen->nama); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pembimbing2">Pembimbing 2 (optional):</label>
                <select name="pembimbing2" id="pembimbing2" class="form-control">
                    <option value="">Pilih Dosen</option>
                    <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dosen->id); ?>" <?php echo e($dosen->id == $tugasAkhir->pembimbing2 ? 'selected' : ''); ?>>
                            <?php echo e($dosen->nama); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="dokumen">Dokumen Tugas Akhir:</label>
                <input type="file" name="dokumen" id="dokumen" class="form-control">
                <?php if($tugasAkhir->dokumen): ?>
                    <p>Current file: <?php echo e($tugasAkhir->dokumen); ?></p>
                <?php endif; ?>
            </div>
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth()->user()->level == 'Admin' || Auth()->user()->level == 'kaprodi' || Auth()->user()->level == 'dosen'): ?>
                    <div class="form-group" style="display: flex;">
                        <label for="status" style="margin-right: 10px;">Status:</label>
                    </div>

                    <div style="display: flex;">
                        <div style="margin-right: 10px;">
                            <input type="radio" id="status_menunggu" name="status" value="Menunggu"
                                <?php echo e($tugasAkhir->status == 'Menunggu' ? 'checked' : ''); ?>>
                            <label for="status_menunggu">Menunggu</label>
                        </div>
                        <div style="margin-right: 10px;">
                            <input type="radio" id="status_disetujui" name="status" value="Disetujui"
                                <?php echo e($tugasAkhir->status == 'Disetujui' ? 'checked' : ''); ?>>
                            <label for="status_disetujui">Disetujui</label>
                        </div>
                        <div style="margin-right: 10px;">
                            <input type="radio" id="status_ditolak" name="status" value="Ditolak"
                                <?php echo e($tugasAkhir->status == 'Ditolak' ? 'checked' : ''); ?>>
                            <label for="status_ditolak">Ditolak</label>
                        </div>
                        <div>
                            <input type="radio" id="status_selesai" name="status" value="Selesai"
                                <?php echo e($tugasAkhir->status == 'Selesai' ? 'checked' : ''); ?>>
                            <label for="status_selesai">Selesai</label>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo e(route('tugas_akhirs.index')); ?>" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary my-3">Update</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/tugas_akhiredit.blade.php ENDPATH**/ ?>