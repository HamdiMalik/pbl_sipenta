@extends('layout.template')

@section('main')
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Penilaian</h1>
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
    <div class="row py-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center mt-3">
                <label class="mr-3 d-flex align-items-center">
                    Search:
                    <input type="search" id="search" class="form-control form-control-sm d-inline-block ml-2"
                        placeholder="" style="width: auto;">
                </label>
                <label class="d-flex align-items-center mx-5">
                    Show
                    <select name="entries" id="entries" class="form-select form-select-sm d-inline-block ml-2"
                        style="width: auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ml-2">entries</span>
                </label>
            </div>

            <div class="col-auto">
                <a href="{{ route('penilaian.create') }}" class="btn btn-primary">Buat Penilaian Baru</a>
            </div>
            {{-- <a href="/tambahpenilaian/{{ $penilaian->id }}" class="btn btn-primary mr-1"><i
                    class="bi bi-bookmark-plus-fill"></i> Buat Penilaian</a> --}}
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Judul Tugas Akhir</th>
                <th>Dosen Penguji</th>
                <th>Nilai</th>
                <th>Komentar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penilaians as $penilaian)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $penilaian->tugasAkhir->judul }}</td>
                    <td class="align-middle">{{ $penilaian->dosenPenguji->nama }}</td>
                    <td class="align-middle">{{ $penilaian->nilai }}</td>
                    <td class="align-middle">{{ $penilaian->komentar }}</td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('penilaian.show', $penilaian->id) }}" class="btn btn-info mr-1">Detail</a>
                            <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-warning mr-1">Edit</a>
                            <form action="{{ route('penilaian.destroy', $penilaian->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus penilaian?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data penilaian</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
