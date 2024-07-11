@extends('layout.template')

@section('main')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Laporan Data Sidang</h1>
        </div>
    </div>
    <table class="table table-bordered border-primary">
        <tbody>
            @if ($sidang->tugasAkhir)
                <tr>
                    <th>Judul Tugas Akhir:</th>
                    <td>{{ $sidang->tugasAkhir->judul }}</td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa:</th>
                    <td>{{ $sidang->tugasAkhir->mahasiswa->nama ?? 'Tidak ada data' }}</td>
                </tr>
                <tr>
                    <th>Dosen Pembimbing 1:</th>
                    <td>{{ $sidang->tugasAkhir->pembimbing_1->nama ?? 'Tidak ada data' }}</td>
                </tr>
                <tr>
                    <th>Dosen Pembimbing 2:</th>
                    <td>{{ $sidang->tugasAkhir->pembimbing_2->nama ?? 'Tidak ada data' }}</td>
                </tr>
                @if ($sidang->penilaians->isNotEmpty())
                    <tr>
                        <th>Dosen Penguji</th>
                        <td>{{ $sidang->penilaians->first()->dosenPenguji->nama }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Akhir</th>
                        <td>{{ $sidang->penilaians->first()->nilai }}</td>
                    </tr>
                @else
                    <tr>
                        <th colspan="2">Data penilaian tidak tersedia.</th>
                    </tr>
                @endif




                {{--  <tr>
                    <th>Laporan Sidang:</th>
                    <td><a href="{{ Storage::url($sidang->tugasAkhir->dokumen) }}" target="_blank">Download</a></td>
                </tr> --}}
            @endif
            @if ($sidang)
                <tr>
                    <th>Tanggal:</th>
                    <td>{{ date_format(date_create($sidang->tanggal), 'd-M-Y') }}</td>
                </tr>
                <tr>
                    <th>Ruangan:</th>
                    <td>{{ $sidang->ruangan->nama ?? 'Tidak ada data' }}</td>
                </tr>
                <tr>
                    <th>Sesi:</th>
                    <td>{{ $sidang->sesi }}</td>
                </tr>
                <tr>
                    <th>Ketua Sidang:</th>
                    <td>{{ $sidang->ketua->nama ?? 'Tidak ada data' }}</td>
                </tr>
                <tr>
                    <th>Sekretaris Sidang:</th>
                    <td>{{ $sidang->sekretaris->nama ?? 'Tidak ada data' }}</td>
                </tr>
                <tr>
                    <th>Anggota:</th>
                    <td>{{ $sidang->anggota }}</td>
                </tr>
                <tr>
                    <th>Status Kelulusan:</th>
                    <td>{{ $sidang->status_kelulusan }}</td>
                </tr>
            @endif


        </tbody>
    </table>
    <button class="btn btn-success mt-3 mb-3" onclick="window.print()">Cetak Berita Acara Sidang</button>
    <a href="{{ route('sidang.index') }}" class="btn btn-primary mt-3 mb-3">Kembali</a>
@endsection
