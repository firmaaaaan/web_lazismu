@extends('layouts.master')
section('title', 'Data Program Akun')
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
            Data Akun{{-- Data {{ $akun->nama_akun }} --}}
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program</th>
                            <th>No. Rekening</th>
                            <th>Deskripsi Program</th>
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach ($programdonasis as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_program }}</td>
                            <td>{{ $item->no_rek }}</td>
                            <td>{!! $item->deskripsi !!}</td>
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
