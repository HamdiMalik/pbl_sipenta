@extends('layout.template')

@section('main')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Detail Data Mahasiswa</h1>
        </div>
    </div>
    <table class="table table-bordered">
        <tbody>
            @if ($mahasiswa->foto)
                <th style="width:200px;" rowspan="6">
                    <img src="{{ asset('storage/uploads/' . $mahasiswa->foto) }}" alt="{{ $mahasiswa->nama }}"
                        style="width:200px;height:300px;">
                </th>
            @else
                <tr>
                    <td rowspan="6" class="center-image">Tidak ada foto</td>
                </tr>
            @endif
            <tr>
                <th>Nama</th>
                <td>{{ $mahasiswa->nama }}</td>
            </tr>
            <tr>
                <th>NIM</th>
                <td>{{ $mahasiswa->nim }}</td>
            </tr>
            <tr>
                <th>Prodi</th>
                <td>{{ $mahasiswa->prodi }}</td>
            </tr>
            <tr>
                <th>Angkatan</th>
                <td>{{ $mahasiswa->angkatan }}</td>
            </tr>
            <tr>
                <th>IPK</th>
                <td>{{ $mahasiswa->ipk }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('mahasiswas.index') }}" class="btn btn-primary">Kembali</a>
@endsection
