@extends('layout.template')

@section('main')
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Ruangan</h1>
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
            <div class="col-auto mt-2">
                {{-- @can('create-sidang') --}}
                <a href="{{ route('ruangan.create') }}" class="btn btn-primary ml-3">Tambah Ruangan</a>
                {{-- @endcan --}}
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Ruangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($ruangan->count() > 0)
                @foreach ($ruangan as $ruangan)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $ruangan->id }}</td>
                        <td class="align-middle">{{ $ruangan->nama }}</td>
                        <td class="align-middle">{{ $ruangan->status }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('ruangan.show', $ruangan) }}" class="btn btn-info mr-1">Detail</a>
                                <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-warning mr-1">Edit</a>
                                <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
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
                    <td class="align-middle text-center" colspan="6">Ruangan tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
