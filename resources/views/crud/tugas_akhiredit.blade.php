@extends('layout.template')

@section('main')
    <div class="card text-center mb-2">
        <div class="card-header">
            <h1>Edit Data Tugas Akhir</h1>
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
    <div>
        <form action="{{ route('tugas_akhirs.update', $tugasAkhir->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" class="form-control"
                    value="{{ old('judul', $tugasAkhir->judul) }}">
            </div>
            <div class="form-group">
                <label for="mahasiswa">Mahasiswa:</label>
                <select name="mahasiswa" id="mahasiswa" class="form-control">
                    <option value="">Pilih Mahasiswa</option>
                    @foreach ($mahasiswas as $mahasiswa)
                        <option value="{{ $mahasiswa->id }}"
                            {{ $mahasiswa->id == $tugasAkhir->mahasiswa_id ? 'selected' : '' }}>
                            {{ $mahasiswa->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pembimbing1">Pembimbing 1:</label>
                <select name="pembimbing1" id="pembimbing1" class="form-control">
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $dosen->id == $tugasAkhir->pembimbing1 ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pembimbing2">Pembimbing 2 (optional):</label>
                <select name="pembimbing2" id="pembimbing2" class="form-control">
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $dosen->id == $tugasAkhir->pembimbing2 ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="dokumen">Dokumen Tugas Akhir:</label>
                <input type="file" name="dokumen" id="dokumen" class="form-control">
                @if ($tugasAkhir->dokumen)
                    <p>Current file: {{ $tugasAkhir->dokumen }}</p>
                @endif
            </div>
            @auth
                @if (Auth()->user()->level == 'Admin' || Auth()->user()->level == 'kaprodi' || Auth()->user()->level == 'dosen')
                    <div class="form-group" style="display: flex;">
                        <label for="status" style="margin-right: 10px;">Status:</label>
                    </div>

                    <div style="display: flex;">
                        <div style="margin-right: 10px;">
                            <input type="radio" id="status_menunggu" name="status" value="Menunggu"
                                {{ $tugasAkhir->status == 'Menunggu' ? 'checked' : '' }}>
                            <label for="status_menunggu">Menunggu</label>
                        </div>
                        <div style="margin-right: 10px;">
                            <input type="radio" id="status_disetujui" name="status" value="Disetujui"
                                {{ $tugasAkhir->status == 'Disetujui' ? 'checked' : '' }}>
                            <label for="status_disetujui">Disetujui</label>
                        </div>
                        <div style="margin-right: 10px;">
                            <input type="radio" id="status_ditolak" name="status" value="Ditolak"
                                {{ $tugasAkhir->status == 'Ditolak' ? 'checked' : '' }}>
                            <label for="status_ditolak">Ditolak</label>
                        </div>
                        <div>
                            <input type="radio" id="status_selesai" name="status" value="Selesai"
                                {{ $tugasAkhir->status == 'Selesai' ? 'checked' : '' }}>
                            <label for="status_selesai">Selesai</label>
                        </div>
                    </div>
                @endif
            @endauth
            <a href="{{ route('tugas_akhirs.index') }}" class="btn btn-secondary mt-3 mb-3">Kembali</a>
            <button type="submit" class="btn btn-primary my-3">Update</button>
        </form>
    </div>
@endsection
