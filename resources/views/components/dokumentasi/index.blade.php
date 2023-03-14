@extends('layouts.master')
@section('title', 'Dokumentasi')
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
            Data Driver
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
                    @role('administrator')
                        <a href="{{ route('dokumentasi.create') }}" class="btn btn-primary my-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Dokumentasi</a>
                    @endrole
                {{-- <a href="" type="button" class="btn btn-success mt-2 ml-2 btn-sm"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="" type="button" class="btn btn-danger mt-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a> --}}
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Text</th>
                            @role('administrator')
                                <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach ($doks as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{!! $item->text !!} </td>
                            @role('administrator')
                                <td>
                                    <a href="{{ route('dokumentasi.show', $item->id) }}" class="btn btn-info btn-sm" title="Tampil"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('dokumentasi.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('dokumentasi.destroy', $item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
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
