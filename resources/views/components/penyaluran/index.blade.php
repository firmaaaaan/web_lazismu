@extends('layouts.master')
@section('title', 'Data Penyaluran')
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
            Log Penyaluran Donasi
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block mb-2">
                        <p><i class="bi bi-check-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-block mb-2">
                        <p><i class="bi bi-lightbulb-fill"></i> <strong> Pemberitahuan! </strong>{{ $message }}</p>
                    </div>
                @endif
                @role('administrator')
                <a href="{{ route('program.salurkan') }}" class="btn btn-success btn-sm mb-2 mr-2" style="float: left" title="Salurkan"><i class="bi bi-box2-heart-fill"></i> Salurkan Donasi</a>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm mb-2" title="Cetak Pertanggal"><i class="bi bi-printer-fill"></i> Cetak Pertanggal</button>
                @endrole
            <div class="table-responsive">
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program Donasi</th>
                            <th>Penerima</th>
                            <th>Nominal (Rp)</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach($penyaluran as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_program }}</td>
                                <td>{{ $item->mustahik->nama }} - {{ $item->mustahik->alamat }}</td>
                                <td>{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>{{ $item->deskripsi_penyaluran }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at )->format('d M Y')  }}</td>
                                <td>
                                    <a href="{{ route('destroy.program.salurkan', $item->id) }}" class="btn btn-danger btn-sm" title="Edit"><i class="bi bi-trash"></i></a>
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
            <h5 class="modal-title" id="exampleModalLabel">Cetak Penyaluran Pertanggal</h5>
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
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            <a href="" type="submit" onclick="this.href='/cetak-penyaluran/pertanggal/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </div>
        </div>
    </div>
</div>
@endsection
