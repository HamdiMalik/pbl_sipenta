<?php $__env->startSection('main'); ?>
    <div class="card text-center mb-2">
        <div class="card-header">
            <h1>Edit Data Sidang</h1>
        </div>
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('sidang.update', $sidang->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="id_tugasakhir" class="form-label">ID Tugas Akhir</label>
            <select name="id_tugasakhir" id="id_tugasakhir" class="form-select" required>
                <option value="">Pilih Judul Tugas Akhir</option>
                <?php $__currentLoopData = $tugasAkhirs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tugasAkhir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tugasAkhir->id); ?>" <?php echo e($sidang->id_tugasakhir == $tugasAkhir->id ? 'selected' : ''); ?>>
                        <?php echo e($tugasAkhir->judul); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo e($sidang->tanggal); ?>"
                required>
        </div>
        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan</label>
            <select name="id_ruang" id="ruangan" class="form-select" required>
                <option value="">Pilih Ruangan</option>
                <?php $__currentLoopData = $ruangans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ruangan->id); ?>" <?php echo e($sidang->id_ruang == $ruangan->id ? 'selected' : ''); ?>>
                        <?php echo e($ruangan->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="sesi" class="form-label">Sesi</label>
            <div>
                <?php $__currentLoopData = [1, 2, 3, 4, 5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sesi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sesi" id="sesi<?php echo e($sesi); ?>"
                            value="<?php echo e($sesi); ?>" <?php echo e($sidang->sesi == $sesi ? 'checked' : ''); ?> required>
                        <label class="form-check-label" for="sesi<?php echo e($sesi); ?>"><?php echo e($sesi); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="ketua_sidang" class="form-label">Ketua Sidang</label>
            <select name="ketua_sidang" id="ketua_sidang" class="form-select" required>
                <option value="">Pilih Ketua Sidang</option>
                <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dosen->id); ?>" <?php echo e($sidang->ketua_sidang == $dosen->id ? 'selected' : ''); ?>>
                        <?php echo e($dosen->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="sekretaris_sidang" class="form-label">Sekretaris Sidang</label>
            <select name="sekretaris_sidang" id="sekretaris_sidang" class="form-select" required>
                <option value="">Pilih Sekretaris Sidang</option>
                <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dosen->id); ?>" <?php echo e($sidang->sekretaris_sidang == $dosen->id ? 'selected' : ''); ?>>
                        <?php echo e($dosen->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>


        <div class="mb-3">
            <label for="anggota" class="form-label">Anggota Penguji (Pilih nama dosen)</label>
            <select name="anggota[]" id="anggota" class="form-select" multiple required>
                <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dosen->id); ?>"><?php echo e($dosen->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <a href="<?php echo e(route('sidang.index')); ?>" class="btn btn-secondary mt-3 mb-2">Kembali</a>
        <button type="submit" class="btn btn-primary mt-3 mb-2">Update</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/sidangedit.blade.php ENDPATH**/ ?>