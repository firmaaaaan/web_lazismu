@extends('layouts.master')
@section('title', 'Report Permintaan Ambulan')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
            Overview
            </div>
            <h2 class="page-title">
            Export Data Permintaan Ambulan
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Tanggal</th>
                            <th>Titik Jemput</th>
                            <th>Tujuan</th>
                            <th>Keterangan</th>
                            <th>Infaq (Rp)</th>
                            <th>Status Permintaan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($permintaanAmbulan as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->nama_pasien }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y')  }}</td>
                            <td>{{ $item->titik_jemput }}</td>
                            <td>{{ $item->rumahsakit->nama_rs }} </td>
                            <td>{!! $item->keterangan !!}</td>
                            <td>{{ number_format($item->infaq , 0, ',', '.') }}</td>
                            <td>
                                @if ($item->status_id ==3)
                                    <div class="btn btn-outline-primary btn-sm">{{ $item->status->nama_status }} </div>
                                @elseif ($item->status_id ==4)
                                    <div class="btn btn-outline-success btn-sm">{{ $item->status->nama_status }} </div>
                                @else
                                    <div class="btn btn-outline-danger btn-sm">{{ $item->status->nama_status }} </div>
                                @endif
                            </td>
                            <td>
                            @if ($item->status_id == 4)
                                <div class="btn btn-outline-success btn-sm">{{ $item->status_perjalanan }}</div>
                            @elseif ($item->status_id == 5)
                                <div>Mohon maaf, permintaan anda ditolak, kemungkinan masalah jarak dan kelengkapan deskripsi. Mohon periksa kembali.</div>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection
