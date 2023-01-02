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
            Data user
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="table-responsive">
                <a href="{{ route('user.create') }}" class="btn btn-primary my-2 mr-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i>Tambah user</a>
                <a href="" type="button" class="btn btn-success my-2 mx-2 btn-sm"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="" type="button" class="btn btn-danger my-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama </th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('user.destroy', $item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
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
