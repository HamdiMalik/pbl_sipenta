@extends('layout.template')

@section('main')
    <div class="card text-center mb-2">
        <div class="card-header">
            <h1>Tambah Data Sidang</h1>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('sidang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_tugasakhir" class="form-label">ID Tugas Akhir</label>
            <select name="id_tugasakhir" id="id_tugasakhir" class="form-select" required>
                <option value="">Pilih Judul Tugas Akhir</option>
                @foreach ($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id }}">{{ $tugasAkhir->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan</label>
            <select name="id_ruang" id="ruangan" class="form-select" required>
                <option value="">Pilih Ruangan</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sesi" class="form-label">Sesi</label>
            <div>
                @foreach ([1, 2, 3, 4, 5] as $sesi)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sesi" id="sesi{{ $sesi }}"
                            value="{{ $sesi }}" required>
                        <label class="form-check-label" for="sesi{{ $sesi }}">{{ $sesi }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="ketua_sidang" class="form-label">Ketua Sidang</label>
            <select name="ketua_sidang" id="ketua_sidang" class="form-select" required>
                <option value="">Pilih Ketua Sidang</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sekretaris_sidang" class="form-label">Sekretaris Sidang</label>
            <select name="sekretaris_sidang" id="sekretaris_sidang" class="form-select" required>
                <option value="">Pilih Sekretaris Sidang</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="anggota" class="form-label">Anggota Penguji (Pilih nama dosen)</label>
            <select name="anggota[]" id="anggota" class="form-select" multiple required>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="mb-3">
            <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_kelulusan" id="status_lulus" value="lulus"
                        required>
                    <label class="form-check-label" for="status_lulus">Lulus</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_kelulusan" id="status_tidak_lulus"
                        value="tidak_lulus" required>
                    <label class="form-check-label" for="status_tidak_lulus">Tidak Lulus</label>
                </div>
            </div>
        </div> --}}
        <a href="{{ route('sidang.index') }}" class="btn btn-secondary ">Kembali</a>
        <button type="submit" class="btn btn-primary ">Submit</button>
    </form>
@endsection
