@extends('layout.template')

@section('main')
    <div>
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Detail Penilaian</h1>
            </div>
        </div>

        <table class="table table-bordered">
            <tbody>
                {{--  <tr>
                    <th scope="row">ID Penilaian</th>
                    <td>{{ $penilaian->id }}</td>
                </tr> --}}
                <tr>
                    <th scope="row">Judul Tugas Akhir</th>
                    <td>{{ $penilaian->tugasAkhir->judul }}</td>
                </tr>
                <tr>
                    <th scope="row">Dosen Penguji</th>
                    <td>{{ $penilaian->dosenPenguji->nama }}</td>
                </tr>
                <tr>
                    <th scope="row">Total Nilai Akhir</th>
                    <td>{{ $penilaian->nilai }}</td>
                </tr>
                <tr>
                    <th scope="row">Komentar</th>
                    <td>{{ $penilaian->komentar }}</td>
                </tr>
            </tbody>
        </table>

        {{--  <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('penilaian.destroy', $penilaian->id) }}" method="POST" class="d-inline"
            onsubmit="return confirm('Hapus penilaian?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form> --}}
        <a href="{{ route('penilaian.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
