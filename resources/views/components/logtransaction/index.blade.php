@extends('layouts.master')
@section('title', 'Data Perpindahan Saldo')
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
            Log Transaksi Perpindahan Saldo
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
                @role('administrator')
                <a href="{{ route('create.transaction') }}" class="btn btn-success btn-sm  mb-2"> <i class="bi bi-wallet-fill"></i> Transfer</a>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm mb-2" title="Cetak Pertanggal"><i class="bi bi-printer-fill"></i>Cetak Pertanggal</button>
                @endrole
            <div class="table-responsive">
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program Donasi Asal</th>
                            <th>Program Donasi Tujuan</th>
                            <th>Nominal (Rp)</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach($logTransaksi as $log)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $log->programdonasi_asal->nama_program }}</td>
                                <td>{{ $log->programdonasi_tujuan->nama_program }}</td>
                                <td>{{ number_format($log->nominal, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->created_at )->format('d M Y')  }}</td>
                                <td>{{ $log->keterangan }}</td>
                                <td>
                                    <a href="{{ route('destroy.transaksi', $log->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cetak Transaksi Pertanggal</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <label for="">Tanggal Awal</label>
                <input type="date" name="tglAwal" id="tglAwal" class="form-control">
                <label for="">Tanggal Akhir</label>
                <input type="date" name="tglAkhir" id="tglAkhir" class="form-control">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            <a href="" type="submit" onclick="this.href='/cetak-transaksi/pertanggal/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </div>
        </div>
    </div>
</div>
@endsection
