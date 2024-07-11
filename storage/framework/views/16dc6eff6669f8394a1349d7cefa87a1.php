<?php $__env->startSection('main'); ?>
    <div>
        <div class="card text-center">
            <div class="card-header">
                <h1>Edit Penilaian</h1>
            </div>
        </div>
        <form action="<?php echo e(route('penilaian.update', $penilaian->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Form untuk memilih judul tugas akhir -->
            <div class="form-group">
                <b><label for="id_tugasakhir">Judul Tugas Akhir:</label></b>
                <select name="id_tugasakhir" id="id_tugasakhir" class="form-control">
                    <?php $__currentLoopData = $tugasAkhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ta->id); ?>" <?php echo e($ta->id ? 'selected' : ''); ?>>
                            <?php echo e($ta->judul); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Form untuk memilih dosen penguji -->
            <div class="form-group">
                <label for="dosen_penguji">Dosen Penguji:</label>
                <select name="dosen_penguji" id="dosen_penguji" class="form-control">
                    <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d->id); ?>" <?php if($d->id === $penilaian->dosen_penguji): ?> selected <?php endif; ?>>
                            <?php echo e($d->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Form untuk memasukkan nilai penilaian -->
            <div class="form-group">
                <!-- Presentasi -->
                <div class="form-group">
                    <h3>1. Presentasi</h3>
                    <!-- Sikap dan Penampilan -->
                    <label for="presentasi_sikap_penampilan">a. Sikap dan Penampilan:</label>
                    <input type="number" name="presentasi_sikap_penampilan" id="presentasi_sikap_penampilan"
                        class="form-control" min="0" max="100"
                        value="<?php echo e($penilaian->presentasi_sikap_penampilan); ?>">

                    <!-- Komunikasi dan Sistematika -->
                    <label for="presentasi_komunikasi_sistematika">b. Komunikasi dan Sistematika:</label>
                    <input type="number" name="presentasi_komunikasi_sistematika" id="presentasi_komunikasi_sistematika"
                        class="form-control" min="0" max="100"
                        value="<?php echo e($penilaian->presentasi_komunikasi_sistematika); ?>">

                    <!-- Penguasaan Materi -->
                    <label for="presentasi_penguasaan_materi">c. Penguasaan Materi:</label>
                    <input type="number" name="presentasi_penguasaan_materi" id="presentasi_penguasaan_materi"
                        class="form-control" min="0" max="100"
                        value="<?php echo e($penilaian->presentasi_penguasaan_materi); ?>">
                </div>

                <!-- Makalah -->
                <div class="form-group">
                    <h3>2. Makalah</h3>
                    <!-- Identifikasi Masalah, Tujuan dan Kontribusi Penelitian -->
                    <label for="makalah_identifikasi_masalah">a. Identifikasi Masalah, Tujuan dan Kontribusi
                        Penelitian:</label>
                    <input type="number" name="makalah_identifikasi_masalah" id="makalah_identifikasi_masalah"
                        class="form-control" min="0" max="100"
                        value="<?php echo e($penilaian->makalah_identifikasi_masalah); ?>">

                    <!-- Relevansi Teori/Referensi Pustaka dan Konsep dengan Masalah Penelitian -->
                    <label for="makalah_relevansi_teori">b. Relevansi Teori/Referensi Pustaka dan Konsep dengan Masalah
                        Penelitian:</label>
                    <input type="number" name="makalah_relevansi_teori" id="makalah_relevansi_teori" class="form-control"
                        min="0" max="100" value="<?php echo e($penilaian->makalah_relevansi_teori); ?>">

                    <!-- Metode Algoritma yang Digunakan -->
                    <label for="makalah_metode_algoritma">c. Metode Algoritma yang Digunakan:</label>
                    <input type="number" name="makalah_metode_algoritma" id="makalah_metode_algoritma" class="form-control"
                        min="0" max="100" value="<?php echo e($penilaian->makalah_metode_algoritma); ?>">

                    <!-- Hasil dan Pembahasan -->
                    <label for="makalah_hasil_pembahasan">d. Hasil dan Pembahasan:</label>
                    <input type="number" name="makalah_hasil_pembahasan" id="makalah_hasil_pembahasan" class="form-control"
                        min="0" max="100" value="<?php echo e($penilaian->makalah_hasil_pembahasan); ?>">

                    <!-- Kesimpulan dan Saran -->
                    <label for="makalah_kesimpulan_saran">e. Kesimpulan dan Saran:</label>
                    <input type="number" name="makalah_kesimpulan_saran" id="makalah_kesimpulan_saran" class="form-control"
                        min="0" max="100" value="<?php echo e($penilaian->makalah_kesimpulan_saran); ?>">

                    <!-- Penggunaan Bahasa dan Tata Tulis -->
                    <label for="makalah_bahasa_tata_tulis">f. Penggunaan Bahasa dan Tata Tulis:</label>
                    <input type="number" name="makalah_bahasa_tata_tulis" id="makalah_bahasa_tata_tulis"
                        class="form-control" min="0" max="100"
                        value="<?php echo e($penilaian->makalah_bahasa_tata_tulis); ?>">
                </div>

                <!-- Produk -->
                <div class="form-group">
                    <h3>3. Produk</h3>
                    <!-- Kesesuaian Fungsional Sistem -->
                    <label for="produk_kesesuaian_fungsional">a. Kesesuaian Fungsional Sistem:</label>
                    <input type="number" name="produk_kesesuaian_fungsional" id="produk_kesesuaian_fungsional"
                        class="form-control" min="0" max="100"
                        value="<?php echo e($penilaian->produk_kesesuaian_fungsional); ?>">
                </div>
            </div>

            <div class="form-group d-flex align-items-center">
                <button type="button" class="btn btn-success mr-3" onclick="hitungTotal()">Hitung Total</button>
                <span id="totalNilai" class="border border-4 p-2"><?php echo e($penilaian->nilai); ?></span>
                <input type="hidden" name="totalNilai" id="totalNilaiInput" value="<?php echo e($penilaian->nilai); ?>">
            </div>
            <div class="form-group">
                <label for="komentar">Komentar:</label>
                <textarea name="komentar" id="komentar" class="form-control" rows="3"><?php echo e($penilaian->komentar); ?></textarea>
            </div>

            <!-- Tombol Simpan -->
            <div>
                <a href="<?php echo e(route('penilaian.index')); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function hitungTotal() {
            // Ambil nilai dari setiap input
            const presentasi_sikap_penampilan = parseFloat(document.getElementById(
                'presentasi_sikap_penampilan').value) || 0;
            const presentasi_komunikasi_sistematika = parseFloat(document.getElementById(
                'presentasi_komunikasi_sistematika').value) || 0;
            const presentasi_penguasaan_materi = parseFloat(document.getElementById(
                'presentasi_penguasaan_materi').value) || 0;
            const makalah_identifikasi_masalah = parseFloat(document.getElementById(
                'makalah_identifikasi_masalah').value) || 0;
            const makalah_relevansi_teori = parseFloat(document.getElementById(
                'makalah_relevansi_teori').value) || 0;
            const makalah_metode_algoritma = parseFloat(document.getElementById(
                'makalah_metode_algoritma').value) || 0;
            const makalah_hasil_pembahasan = parseFloat(document.getElementById(
                'makalah_hasil_pembahasan').value) || 0;
            const makalah_kesimpulan_saran = parseFloat(document.getElementById(
                'makalah_kesimpulan_saran').value) || 0;
            const makalah_bahasa_tata_tulis = parseFloat(document.getElementById(
                'makalah_bahasa_tata_tulis').value) || 0;
            const produk_kesesuaian_fungsional = parseFloat(document.getElementById(
                    'produk_kesesuaian_fungsional')
                .value) || 0;

            // Hitung total nilai berdasarkan bobot
            const totalNilai =
                (presentasi_sikap_penampilan * 0.05) +
                (presentasi_komunikasi_sistematika * 0.05) +
                (presentasi_penguasaan_materi * 0.20) +
                (makalah_identifikasi_masalah * 0.05) +
                (makalah_relevansi_teori * 0.05) +
                (makalah_metode_algoritma * 0.10) +
                (makalah_hasil_pembahasan * 0.15) +
                (makalah_kesimpulan_saran * 0.05) +
                (makalah_bahasa_tata_tulis * 0.05) +
                (produk_kesesuaian_fungsional * 0.25);

            // Tampilkan total nilai
            document.getElementById('totalNilai').innerText = totalNilai.toFixed(2);
            document.getElementById('totalNilaiInput').value = totalNilai.toFixed(2);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pbl_sipenta\resources\views/crud/penilaianedit.blade.php ENDPATH**/ ?>