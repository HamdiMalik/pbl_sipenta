@extends('layout.template')

@section('main')
    <div>
        <div class="card text-center mb-2">
            <div class="card-header">
                <h1>Tambah Data Dosen</h1>
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

        <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Dosen :</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama"
                        placeholder="Masukkan Nama Dosen">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nip" class="col-sm-2 col-form-label">NIP :</label>
                <div class="col-sm-10">
                    <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="no_telp" class="col-sm-2 col-form-label">Nomor Telepon :</label>
                <div class="col-sm-10">
                    <input type="text" name="no_telp" class="form-control" id="no_telp"
                        placeholder="Masukkan Nomor Telepon">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="level" class="col-sm-2 col-form-label">Jabatan Akademik :</label>
                <div class="col-sm-10">
                    <select class="form-control" id="level" name="level">
                        <option value="">Pilih Jabatan</option>
                        <option value="dosen" {{ old('level') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="kaprodi" {{ old('level') == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                    </select>
                </div>
            </div>


            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto :</label>
                <div class="col-sm-10">
                    <input type="file" name="foto" class="form-control" id="foto">
                </div>
            </div>
            <a href="{{ route('dosen.index') }}" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
