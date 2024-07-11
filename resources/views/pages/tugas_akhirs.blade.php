@extends('layout.template')

@section('main')
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Tugas Akhir</h1>
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
        <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
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
            @auth
                @if (Auth()->user()->level == 'Admin' || Auth()->user()->level == 'mahasiswa')
                    <div class="mt-3">
                        <a href="{{ route('tugas_akhirs.create') }}" class="btn btn-primary ml-3">Tambah Tugas Akhir</a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Mahasiswa</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                @auth
                    @if (Auth()->user()->level == 'Admin' || Auth()->user()->level == 'kaprodi' || Auth()->user()->level == 'dosen')
                        <th>Aksi</th>
                    @endif
                @endauth

            </tr>
        </thead>
        <tbody>
            @if ($tugas_akhirs->count() > 0)
                @foreach ($tugas_akhirs as $tugas_akhir)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $tugas_akhir->judul }}</td>
                        <td class="align-middle">{{ $tugas_akhir->mahasiswa->nama ?? 'Tidak ada data' }}</td>
                        <td class="align-middle">{{ $tugas_akhir->pembimbing_1->nama }}</td>
                        <td class="align-middle">{{ $tugas_akhir->pembimbing_2->nama }}</td>
                        @auth
                            @if (Auth()->user()->level == 'kaprodi' || Auth()->user()->level == 'dosen')
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('tugas_akhirs.show', $tugas_akhir) }}"
                                            class="btn btn-info mr-1">Detail</a>
                                    </div>
                                </td>
                            @endif
                        @endauth
                        @auth
                            @if (Auth()->user()->level == 'Admin')
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('tugas_akhirs.show', $tugas_akhir) }}"
                                            class="btn btn-info mr-1">Detail</a>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('tugas_akhirs.edit', $tugas_akhir) }}"
                                            class="btn btn-warning mr-1">Edit</a>
                                        <form action="{{ route('tugas_akhirs.destroy', $tugas_akhir->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="align-middle text-center" colspan="6">Tugas akhir tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection
