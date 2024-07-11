@extends('layout.template')

@section('main')
    <div>
        <div class="card text-center mb-2">
            <div class="card-header">
                <h1>Tambah Data Ruangan</h1>
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

        <form action="{{ route('ruangan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Ruangan:</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Ruangan"
                    required>
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas:</label>
                <input type="number" min="1" name="kapasitas" class="form-control" id="kapasitas"
                    placeholder="Masukkan Kapasitas" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
