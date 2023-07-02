@extends('layouts.master')
@section('title', 'Data Akun')
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
            Data Mustahik
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block mb-2">
                                <p><i class="bi bi-check-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
                            </div>
                @endif
                @if ($message = Session::get('info'))
                            <div class="alert alert-primary alert-block mb-2">
                                <p><i class="bi bi-lightbulb-fill"></i><strong> Pemberitahuan! </strong>{{ $message }}</p>
                            </div>
                @endif
                @if ($message = Session::get('delete'))
                            <div class="alert alert-primary alert-block mb-2">
                                <p><i class="bi bi-lightbulb-fill"></i><strong> Pemberitahuan! </strong>{{ $message }}</p>
                            </div>
                @endif
            <div class="table-responsive">
                @role('administrator')
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary my-2 mr-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Mustahik</button>
                @endrole
                <table class="table" id="tdatatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
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
                        @foreach ($mustahik as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            @role('administrator')
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#example{{ $item->id }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                    <a href="{{ route('destroy.mustahik', $item->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Input data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('store.mustahik') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid
                            @enderror" value="{{ old('nama') }}" name="nama">
                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">Alamat</label>
                            <textarea type="text" class="form-control @error('alamat') is-invalid
                            @enderror" value="{{ old('alamat') }}" name="alamat"></textarea>
                            @error('nama_akun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
@foreach ($mustahik as $item)
<div class="modal fade" id="example{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Input data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('update.mustahik', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" value="{{ $item->nama }}" class="form-control @error('nama') is-invalid
                            @enderror" value="{{ old('nama') }}" name="nama">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">Alamat</label>
                            <textarea type="text" value="" class="form-control @error('alamat') is-invalid
                            @enderror" value="{{ old('alamat') }}" name="alamat">{{ $item->alamat }}</textarea>
                        @error('nama_akun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
@endsection
