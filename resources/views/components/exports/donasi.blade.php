@extends('layouts.master')
@section('title', 'Report Donasi')
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
            Export Data Donasi
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
                            <th>Nama Donatur</th>
                            <th>No. Rekening</th>
                            <th>Program Donasi</th>
                            <th>Jumlah Donasi (Rp)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    @php
                        $no=1
                    @endphp
                    <tbody>
                        @foreach ($donasi as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                @if ($item->id_donatur)
                                    {{ $item->donatur->nama_donatur }}
                                @else
                                    {{ $item->nama_donatur }}
                                @endif
                            </td>
                            <td>{{ $item->no_rek }}</td>
                            <td>{{ $item->programDonasi->nama_program }}</td>
                            <td>{{ number_format($item->jml_donasi, 0, ',', '.') }}</td>
                            <td>{!! $item->keterangan !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        {{ $donasi->links()}}
    </div>
</div>
@endsection
