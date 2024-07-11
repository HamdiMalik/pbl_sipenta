<?php $__env->startSection('main'); ?>
    <div>
        <div class="card text-center mb-2">
            <div class="card-header">
                <h1>Tambah Data Mahasiswa</h1>
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

        <form action="<?php echo e(route('mahasiswas.store')); ?>" method="POST" enctype="multipart/form-data"> <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="nama">Nama Mahasiswa :</label>
                <input type="text" name="nama" class="form-control" id="nama"
                    placeholder="Masukkan Nama Mahasiswa">
            </div>

            <div class="form-group">
                <label for="nim">NIM :</label>
                <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM">
            </div>

            <div class="form-group">
                <label for="prodi">Prodi :</label>
                <select name="prodi" id="prodi" class="form-control">
                    <option value="">Pilih Prodi</option>
                    <option value="D4-Teknologi Rekayasa Perangkat Lunak">D4-Teknologi Rekayasa Perangkat Lunak</option>
                    <option value="D4-Animasi">D4-Animasi</option>
                    <option value="D3-Manajemen Informatika">D3-Manajemn Informatika</option>
                    <option value="D3-Teknik Komputer">D3-Teknik Komputer</option>
                    <option value="D3-Sistem Informasi (PSDKU)">D3-Sistem Informasi (PSDKU)</option>
                    <option value="D2-Administrasi Jaringan Komputer">D2-Administrasi Jaringan Komputer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan :</label>
                <input type="text" name="angkatan" class="form-control" id="angkatan"
                    placeholder="Masukkan Angkatan Mahasiswa">
            </div>
            <div class="form-group">
                <label for="ipk">IPK :</label>
                <input type="text" name="ipk" class="form-control" id="ipk"
                    placeholder="Masukkan IPK Mahasiswa">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="text" name="email" class="form-control" id="email"
                    placeholder="Masukkan Email Mahasiswa">
            </div>
            <div class="form-group">
                <label for="foto">Foto :</label>
                <input type="file" name="foto" class="form-control" id="foto">
            </div>
            <a href="<?php echo e(route('mahasiswas.index')); ?>" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/mahasiswacreate.blade.php ENDPATH**/ ?>