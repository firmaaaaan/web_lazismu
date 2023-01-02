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
            Data Rumah Sakit
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="table-responsive">
                <button data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-primary btn-sm my-2 mx-2" style="float: right"><i class="bi bi-plus-square"></i> Tambah Rumah Sakit</button>
                <a href="" type="button" class="btn btn-success btn-sm mt-2 ml-2"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="" type="button" class="btn btn-danger btn-sm mt-2"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Rumah Sakit</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rumahSakit as $item)
                        <tr>
                            <td>{{ $item->nama_rs }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                <a href="{{ route('rumahsakit.destroy', $item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $rumahSakit->links() }}
    </div>
</div>

    <!-- Modal -->
        <div class="modal modal-blur fade" id="modal-team" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Input Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rumahsakit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Nama Rumah Sakit</label>
                        <input type="text"  name="nama_rs" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Alamat</label>
                        <textarea type="date" name="alamat" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Button trigger modal -->
@foreach ($rumahSakit as $item)
    <!-- Modal -->
        <div class="modal modal-blur fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Input Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rumahsakit.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Nama Rumah Sakit</label>
                        <input type="text" value="{{ $item->nama_rs }}" name="nama_rs" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Alamat</label>
                        <textarea type="date" name="alamat" class="form-control">{{ $item->alamat }}</textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
@endforeach

@endsection
