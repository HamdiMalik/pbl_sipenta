@extends('layout.template')

@section('main')
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Sidang</h1>
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
            <div class="col-auto">
                {{-- @can('create-sidang') --}}
                <a href="{{ route('sidang.create') }}" class="btn btn-primary ml-3">Tambah Sidang</a>
                {{-- @endcan --}}
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Judul Tugas Akhir</th>
                <th>Tanggal Sidang</th>
                <th>Sesi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($sidangs->count() > 0)
                @foreach ($sidangs as $sidang)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $sidang->tugasAkhir->judul }}</td>
                        <td class="align-middle">{{ $sidang->tanggal }}</td>
                        <td class="align-middle">{{ $sidang->sesi }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('sidang.show', $sidang->id) }}" class="btn btn-info mr-1">Detail</a>
                                @cannot('isDosen')
                                    <a href="{{ route('sidang.edit', $sidang->id) }}" class="btn btn-warning mr-1">Edit</a>
                                    <form action="{{ route('sidang.destroy', $sidang->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endcannot
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="text-center">No data available</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{--  <div>
        @if ($sidangs->hasPages())
            <a href="{{ $sidangs->previousPageUrl() }}" class="btn btn-primary">Previous</a>
        @else
            <span class="btn btn-primary disabled">Previous</span>
        @endif

        {{ $sidangs->links('pagination::bootstrap-4') }}

        @if ($sidangs->hasMorePages())
            <a href="{{ $sidangs->nextPageUrl() }}" class="btn btn-primary">Next</a>
        @else
            <span class="btn btn-primary disabled">Next</span>
        @endif

    </div> --}}
@endsection
