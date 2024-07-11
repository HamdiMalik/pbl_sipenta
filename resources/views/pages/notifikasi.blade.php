@extends('layout.template')

@section('main')
<div class="row">
  <div class="col">
    <h1 class="mb-4">Data Notifikasi</h1>
  </div>
  <div class="col-auto">
    <a href="{{ route('notifikasi.create') }}" class="btn btn-primary">Tambah Notifikasi</a>
  </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
      <div>
        <label>
          Show
          <select name="entries" id="entries" class="form-select form-select-sm d-inline-block" style="width: auto; display: inline;">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          entries
        </label>
        </div>
        <div id="datatable_info" class="mr-3"></div>
        <div>
            <label>
                Search:
                <input type="search" id="search" class="form-control form-control-sm d-inline-block" placeholder="" style="width: auto; display: inline;">
            </label>
        </div>
    </div>
  </div>
<table class="table table-bordered">
  <thead class="table-primary">
    <tr>
      <th>No</th>
      <th>ID</th>
      <th>Judul</th>
      <th>Isi</th>
      <th>Penerima</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @if($notifikasis->count() > 0)
      @foreach ($notifikasis as $item)
        <tr>
          <td class="align-middle">{{ $loop->iteration }}</td>
          <td class="align-middle">{{ $item->id }}</td>
          <td class="align-middle">{{ $item->judul }}</td>
          <td class="align-middle">{{ $item->isi }}</td>
          <td class="align-middle">{{ $item->penerima }}</td>
          <td class="align-middle">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('notifikasi.show', $item->id) }}" class="btn btn-info">Detail</a>
                <a href="{{ route('notifikasi.edit', $item->id) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('notifikasi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
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
        <td class="align-middle text-center" colspan="6">Notifikasi tidak ditemukan</td>
      </tr>
    @endif
  </tbody>
</table>
<div>
    @if ($notifikasis->onFirstPage())
        <span class="btn btn-secondary disabled">Previous</span>
    @else
        <a href="{{ $notifikasis->previousPageUrl() }}" class="btn btn-primary">Previous</a>
    @endif

    @if ($notifikasis->hasMorePages())
        <a href="{{ $notifikasis->nextPageUrl() }}" class="btn btn-primary">Next</a>
    @else
        <span class="btn btn-primary disabled">Next</span>
    @endif
  </div>
@endsection
