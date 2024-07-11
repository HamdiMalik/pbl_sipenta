@extends('layout.template')

@section('main')
<div class="row">
  <div class="col">
    <h1 class="mb-4">Detail Notifikasi</h1>

  </div>
</div>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Judul: {{ $notifikasi->judul }}</h5>
        <p class="card-text">Isi: {{ $notifikasi->isi }}</p>
        <p class="card-text">Penerima: {{ $notifikasi->penerima }}</p>
        <a href="{{ route('notifikasi.edit', $notifikasi->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
  <a href="{{ route('notifikasi.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
