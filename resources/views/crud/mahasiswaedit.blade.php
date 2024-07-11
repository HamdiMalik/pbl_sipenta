@extends('layout.template')

@section('main')
    <div>
        <div class="card text-center mb-2">
            <div class="card-header">
                <h1>Edit Data Mahasiswa</h1>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama Mahasiswa :</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Mahasiswa"
                    value="{{ $mahasiswa->nama }}">
            </div>

            <div class="form-group">
                <label for="nim">NIM :</label>
                <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM"
                    value="{{ $mahasiswa->nim }}">
            </div>

            <div class="form-group">
                <label for="prodi">Prodi :</label>
                <select name="prodi" id="prodi" class="form-control">
                    <option value="">Pilih Prodi</option>
                    <option value="D4-Teknologi Rekayasa Perangkat Lunak"
                        {{ $mahasiswa->prodi == 'D4-Teknologi Rekayasa Perangkat Lunak' ? 'selected' : '' }}>D4-Teknologi
                        Rekayasa Perangkat Lunak</option>
                    <option value="D4-Animasi" {{ $mahasiswa->prodi == 'D4-Animasi' ? 'selected' : '' }}>D4-Animasi</option>
                    <option value="D3-Manajemen Informatika"
                        {{ $mahasiswa->prodi == 'D3-Manajemen Informatika' ? 'selected' : '' }}>D3-Manajemen Informatika
                    </option>
                    <option value="D3-Teknik Komputer" {{ $mahasiswa->prodi == 'D3-Teknik Komputer' ? 'selected' : '' }}>
                        D3-Teknik Komputer</option>
                    <option value="D3-Sistem Informasi (PSDKU)"
                        {{ $mahasiswa->prodi == 'D3-Sistem Informasi (PSDKU)' ? 'selected' : '' }}>D3-Sistem Informasi
                        (PSDKU)</option>
                    <option value="D2-Administrasi Jaringan Komputer"
                        {{ $mahasiswa->prodi == 'D2-Administrasi Jaringan Komputer' ? 'selected' : '' }}>D2-Administrasi
                        Jaringan Komputer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="angkatan">Angkatan :</label>
                <input type="text" name="angkatan" class="form-control" id="angkatan"
                    placeholder="Masukkan Angkatan Mahasiswa" value="{{ $mahasiswa->angkatan }}">
            </div>

            <div class="form-group">
                <label for="ipk">IPK :</label>
                <input type="text" name="ipk" class="form-control" id="ipk"
                    placeholder="Masukkan IPK Mahasiswa" value="{{ $mahasiswa->ipk }}">
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="text" name="email" class="form-control" id="email"
                    placeholder="Masukkan Email Mahasiswa" value="{{ $mahasiswa->email }}">
            </div>

            <div class="form-group">
                <label for="foto">Foto :</label>
                <input type="file" name="foto" class="form-control" id="foto">
                @if ($mahasiswa->foto)
                    <th style="width:200px;" rowspan="6">
                        <img src="{{ asset('storage/uploads/' . $mahasiswa->foto) }}" alt="{{ $mahasiswa->nama }}"
                            style="width:200px;height:300px;">
                    </th>
                @endif
            </div>


            <a href="{{ route('mahasiswas.index') }}" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
