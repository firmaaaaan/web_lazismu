@extends('layouts.master')
@section('title', 'Data Donatur')
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
            Data Donatur
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('update'))
                <div class="alert alert-primary alert-block mb-2">
                    <p><i class="bi bi-lightbulb-fill"></i><strong> Pemberitahuan! </strong>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('delete'))
                <div class="alert alert-primary alert-block mb-2">
                    <p><i class="bi bi-lightbulb-fill"></i><strong> Pemberitahuan! </strong>{{ $message }}</p>
                </div>
            @endif
            @role('administrator')
                    <a href="{{ route('donatur.tambah') }}" class="btn btn-primary my-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Donatur</a>
            @endrole
                <div class="table-responsive">
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Donatur</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            @role('administrator')
                                <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    @php
                        $no=1
                    @endphp
                    <tbody>
                        @foreach ($donatur as $item)

                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_donatur }}</td>
                            <td>{{ $item->tempat_lahir }}</td>
                            <td>{{ $item->tanggal_lahir }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->alamat }}</td>
                            @role('administrator')
                                <td>
                                    <a href="{{ route('donatur.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square" title="Edit"></i></a>
                                    <a href="{{ route('donatur.delete', $item->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash" title="Edit"></i></a>
                                    <a href="{{ route('invoice', ['id' => $item->id]) }}" class="btn btn-warning btn-sm" title="Cetak"><i class="bi bi-printer-fill"></i></a>
                                </td>
                            @endrole
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
