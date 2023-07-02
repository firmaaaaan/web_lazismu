@extends('layouts.master')
@section('title', 'Data Rumah Sakit')
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
            <div class="card-body">
                @if ($message = Session::get('Success'))
                    <div class="alert alert-success alert-block mb-2">
                        <p><i class="bi bi-check-circle-fill"></i> <strong>Berhasil!</strong> {{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('delete'))
                    <div class="alert alert-primary alert-block mb-2">
                        <p><i class="bi bi-check-circle-fill"></i> <strong>Pemberitahuan!</strong> {{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('Update'))
                    <div class="alert alert-primary alert-block mb-2">
                        <p><i class="bi bi-lightbulb-fill"></i> <strong>Pemberitahuan!</strong>{{ $message }}</p>
                    </div>
                @endif
            <div class="table-responsive">
                @role('administrator')
                    <button data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-primary btn-sm my-2" style="float: right"><i class="bi bi-plus-square"></i> Tambah Rumah Sakit</button>
                @endrole
                {{-- <a href="" type="button" class="btn btn-success btn-sm mt-2 ml-2"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="" type="button" class="btn btn-danger btn-sm mt-2"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a> --}}
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Rumah Sakit</th>
                            <th>Alamat</th>
                            @role('administrator')
                                <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach ($rumahSakit as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_rs }}</td>
                            <td>{{ $item->alamat }}</td>
                            @role('administrator')
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleted{{ $item->id }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                    {{-- <a href="" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a> --}}
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
                        <input type="text" value="{{ old('nama_rs') }}" name="nama_rs" class="form-control @error('nama_rs') is-invalid
                        @enderror">
                        @error('nama_rs')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Alamat</label>
                        <textarea type="date" name="alamat" class="form-control @error('alamat') is-invalid
                        @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
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
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
@endforeach

@foreach ($rumahSakit as $item)
    <div class="modal fade" id="deleted{{ $item->id }}" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apa anda yakin?</div>
                <div>Jika {{ $item->nama_rs }} dihapus maka permintaan ambulan yang terkait akan terhapus permanen.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('rumahsakit.destroy', $item->id) }}"  class="btn btn-danger  btn-sm">Iya, hapus RS</a>
            </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
