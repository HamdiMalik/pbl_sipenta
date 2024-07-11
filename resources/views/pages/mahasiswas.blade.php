@extends('layout.template')

@section('main')

    <div class="card text-center">
        <div class="card-header">
            <h1>Data Mahasiswa</h1>
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
    </div>
    <div class="row py-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            {{-- <div>
                <label>
                    Search:
                    <input type="search" id="search" class="form-control form-control-sm d-inline-block" placeholder=""
                        style="width: auto; display: inline;">
                </label>
            </div> --}}
            <div>
                <form action="{{ route('mahasiswas.import') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                    @csrf
                    <button class="btn btn-success mb-2"><i class="fa fa-file"> Import</i></button>
                    <a class="btn btn-warning mb-2" href="/exportmahasiswa">
                        <i class="fa fa-download"> Ekspor</i>
                    </a>
                    <input type="file" name="file" class="form-control mb-2">
                </form>


            </div>

            <div id="datatable_info" class="mr-3"></div>

            <div>
                <div class="col-auto">
                    <div>
                        <label>
                            Show
                            <select name="entries" id="entries" class="form-select form-select-sm d-inline-block"
                                style="width: auto; display: inline;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            entries
                        </label>
                        {{--  @can('create-mahasiswa') --}}
                        <a href="{{ route('mahasiswas.create') }}" class="btn btn-primary ml-3">Tambah Mahasiswa</a>
                        {{-- @endcan --}}
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>IPK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($mahasiswas->count() > 0)
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $mahasiswa->nama }}</td>
                            <td class="align-middle">{{ $mahasiswa->nim }}</td>
                            <td class="align-middle">{{ $mahasiswa->prodi }}</td>
                            <td class="align-middle">{{ $mahasiswa->angkatan }}</td>
                            <td class="align-middle">{{ $mahasiswa->ipk }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('mahasiswa.show', $mahasiswa) }}"
                                        class="btn btn-info mr-1">Detail</a>
                                    <a href="{{ route('mahasiswas.edit', $mahasiswa->id) }}"
                                        class="btn btn-warning mr-1">Edit</a>
                                    <form action="{{ route('mahasiswas.destroy', $mahasiswa->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="align-middle text-center" colspan="6">Mahasiswa tidak ditemukan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endsection
