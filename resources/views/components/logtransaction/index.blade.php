@extends('layouts.master')
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
            Log Transaksi
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
                            <th>Program Donasi Asal</th>
                            <th>Program Donasi Tujuan</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->programdonasi->nama_program }}</td>
                                <td>{{ $log->programdonasi_tujuan->nama_program }}</td>
                                <td>Rp.{{ number_format($log->nominal, 0, ',', '.') }}</td>
                                <td>{{ $log->created_at }}</td>
                                <td>{{ $log->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
