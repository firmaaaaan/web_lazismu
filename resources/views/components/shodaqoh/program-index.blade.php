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
            Data {{ $programDonasi->nama_program }}
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <strong> TOTAL DONASI : Rp.{{ number_format($totalDonationForProgram, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <strong>SISA DONASI : Rp.{{ number_format($programDonasi->jumlah_donasi_program , 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block mb-2">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block mb-2">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
            <div class="table-responsive">
                <a href="{{ route('donasi.Programsalurkan', $programDonasi->id) }}" class="btn btn-primary btn-sm mb-2" title="Salurkan"><i class="bi bi-box2-heart-fill"></i>Salurkan Donasi</a>
                {{-- <a href="{{ route('donasi.create') }}" type="button" class="btn btn-primary btn-sm mr-2" style="float: right"><i class="bi bi-plus-square"></i>Tambah donasi</a>
                <a href="{{ route('exportPdf') }} " type="button" class="btn btn-danger my-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a> --}}
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>Nama Customer</th>
                            <th>No. Rekening</th>
                            <th>Jumlah Donasi</th>
                            <th>Keterangan</th>
                            <th>Status Donasi</th>
                            <th>Status Penyaluran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->no_rek }}</td>
                            <td>{{ $item->jml_donasi }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                            @if ($item->status_id ==1)
                                <div class="btn btn-outline-danger btn-sm">{{ $item->status->nama_status }}</div>
                            @else
                                <div class="btn btn-outline-success btn-sm">{{ $item->status->nama_status }}</div>
                            @endif
                            </td>
                            <td>
                                @if ($item->status_penyaluran=='Belum Tersalurkan')
                                    <div class="btn btn-outline-danger btn-sm">{{ $item->status_penyaluran }}</div>
                                @else
                                    <div class="btn btn-outline-success btn-sm">{{ $item->status_penyaluran }}</div>
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
</div>
@endsection
