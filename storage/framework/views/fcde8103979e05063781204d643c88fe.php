<?php $__env->startSection('main'); ?>
    <div>
        <div class="card text-center mb-2">
            <div class="card-header">
                <h1>Edit Data Mahasiswa</h1>
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

        <form action="<?php echo e(route('mahasiswas.update', $mahasiswa->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="nama">Nama Mahasiswa :</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Mahasiswa"
                    value="<?php echo e($mahasiswa->nama); ?>">
            </div>

            <div class="form-group">
                <label for="nim">NIM :</label>
                <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM"
                    value="<?php echo e($mahasiswa->nim); ?>">
            </div>

            <div class="form-group">
                <label for="prodi">Prodi :</label>
                <select name="prodi" id="prodi" class="form-control">
                    <option value="">Pilih Prodi</option>
                    <option value="D4-Teknologi Rekayasa Perangkat Lunak"
                        <?php echo e($mahasiswa->prodi == 'D4-Teknologi Rekayasa Perangkat Lunak' ? 'selected' : ''); ?>>D4-Teknologi
                        Rekayasa Perangkat Lunak</option>
                    <option value="D4-Animasi" <?php echo e($mahasiswa->prodi == 'D4-Animasi' ? 'selected' : ''); ?>>D4-Animasi</option>
                    <option value="D3-Manajemen Informatika"
                        <?php echo e($mahasiswa->prodi == 'D3-Manajemen Informatika' ? 'selected' : ''); ?>>D3-Manajemen Informatika
                    </option>
                    <option value="D3-Teknik Komputer" <?php echo e($mahasiswa->prodi == 'D3-Teknik Komputer' ? 'selected' : ''); ?>>
                        D3-Teknik Komputer</option>
                    <option value="D3-Sistem Informasi (PSDKU)"
                        <?php echo e($mahasiswa->prodi == 'D3-Sistem Informasi (PSDKU)' ? 'selected' : ''); ?>>D3-Sistem Informasi
                        (PSDKU)</option>
                    <option value="D2-Administrasi Jaringan Komputer"
                        <?php echo e($mahasiswa->prodi == 'D2-Administrasi Jaringan Komputer' ? 'selected' : ''); ?>>D2-Administrasi
                        Jaringan Komputer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="angkatan">Angkatan :</label>
                <input type="text" name="angkatan" class="form-control" id="angkatan"
                    placeholder="Masukkan Angkatan Mahasiswa" value="<?php echo e($mahasiswa->angkatan); ?>">
            </div>

            <div class="form-group">
                <label for="ipk">IPK :</label>
                <input type="text" name="ipk" class="form-control" id="ipk"
                    placeholder="Masukkan IPK Mahasiswa" value="<?php echo e($mahasiswa->ipk); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="text" name="email" class="form-control" id="email"
                    placeholder="Masukkan Email Mahasiswa" value="<?php echo e($mahasiswa->email); ?>">
            </div>

            <div class="form-group">
                <label for="foto">Foto :</label>
                <input type="file" name="foto" class="form-control" id="foto">
                <?php if($mahasiswa->foto): ?>
                    <th style="width:200px;" rowspan="6">
                        <img src="<?php echo e(asset('storage/uploads/' . $mahasiswa->foto)); ?>" alt="<?php echo e($mahasiswa->nama); ?>"
                            style="width:200px;height:300px;">
                    </th>
                <?php endif; ?>
            </div>


            <a href="<?php echo e(route('mahasiswas.index')); ?>" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/mahasiswaedit.blade.php ENDPATH**/ ?>