@extends('layout.template')

@section('main')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Detail Data Dosen</h1>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                @if ($dosen->foto)
                    <tr>
                        <td style="width:200px;" rowspan="5">
                            <img src="{{ asset('storage/uploads/' . $dosen->foto) }}" alt="{{ $dosen->nama }}"
                                style="width:200px;height:300px;">
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>NIP</th>
                    <td>{{ $dosen->nip }}</td>
                </tr>
                <tr>
                    <th>Nama Dosen</th>
                    <td>{{ $dosen->nama }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $dosen->no_telp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $dosen->email }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('dosen.index') }}" class="btn btn-primary mb-3">Kembali</a>
    </div>
@endsection
