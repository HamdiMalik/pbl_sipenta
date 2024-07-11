@extends('layout.template')

@section('main')
    <div class="card text-center mb-2">
        <div class="card-header">
            <h1>Edit Data Sidang</h1>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sidang.update', $sidang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_tugasakhir" class="form-label">ID Tugas Akhir</label>
            <select name="id_tugasakhir" id="id_tugasakhir" class="form-select" required>
                <option value="">Pilih Judul Tugas Akhir</option>
                @foreach ($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id }}" {{ $sidang->id_tugasakhir == $tugasAkhir->id ? 'selected' : '' }}>
                        {{ $tugasAkhir->judul }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $sidang->tanggal }}"
                required>
        </div>
        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan</label>
            <select name="id_ruang" id="ruangan" class="form-select" required>
                <option value="">Pilih Ruangan</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}" {{ $sidang->id_ruang == $ruangan->id ? 'selected' : '' }}>
                        {{ $ruangan->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sesi" class="form-label">Sesi</label>
            <div>
                @foreach ([1, 2, 3, 4, 5] as $sesi)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sesi" id="sesi{{ $sesi }}"
                            value="{{ $sesi }}" {{ $sidang->sesi == $sesi ? 'checked' : '' }} required>
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
                    <option value="{{ $dosen->id }}" {{ $sidang->ketua_sidang == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sekretaris_sidang" class="form-label">Sekretaris Sidang</label>
            <select name="sekretaris_sidang" id="sekretaris_sidang" class="form-select" required>
                <option value="">Pilih Sekretaris Sidang</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ $sidang->sekretaris_sidang == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
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
        <a href="{{ route('sidang.index') }}" class="btn btn-secondary mt-3 mb-2">Kembali</a>
        <button type="submit" class="btn btn-primary mt-3 mb-2">Update</button>
    </form>
@endsection
