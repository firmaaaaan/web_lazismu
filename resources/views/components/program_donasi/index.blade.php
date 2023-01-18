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
            Data Program Donasi
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
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('Update'))
                    <div class="alert alert-primary alert-block mb-2">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            <div class="table-responsive">
                <button data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-primary my-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Program</button>
                {{-- <a href="" type="button" class="btn btn-success mt-2 ml-2 btn-sm"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="" type="button" class="btn btn-danger mt-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a> --}}
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            {{-- <th>Akun</th> --}}
                            <th>Nama Program</th>
                            <th>No. Rekening</th>
                            <th>Deskripsi Program</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach ($programDonasi as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            {{-- <td>{{ $item->id_akun }}</td> --}}
                            <td>{{ $item->nama_program }}</td>
                            <td>{{ $item->no_rek }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-primary btn-sm"" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                <a href="{{ route('program.donasi.destroy', $item->id) }}" class="btn btn-danger btn-sm"" title="Hapus"><i class="bi bi-trash"></i></a>
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

    <div class="modal modal-blur fade" id="modal-team" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Input Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('program.donasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <div>
                        <label for="">Nama Akun</label>
                        <select name="id_akun" id="" class="form-control">
                            <option value="">--Pilih Akun--</option>
                            @foreach ($akun as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Nama Program Donasi</label>
                        <input type="text" name="nama_program" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">No. Rekening</label>
                        <input type="text" name="no_rek" class="form-control" placeholder="contoh: BSI 7135452829 a/n Firmansyah">
                    </div>
                    <div>
                        <label class="form-label">Deskripsi</label>
                        <textarea type="date" id="editor" name="deskripsi" class="form-control"></textarea>
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

    @foreach ($programDonasi as $item)
    <div class="modal modal-blur fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Input Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('program.donasi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Foto</label>
                        <input type="file" value="{{ $item->foto }}" name="foto" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Nama Program Donasi</label>
                        <input type="text" value="{{ $item->nama_program }}" name="nama_program" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">No. Rekening</label>
                        <input type="text" value="{{ $item->no_rek }}" name="no_rek" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Deskripsi</label>
                        <textarea type="date" id="editor" name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach
@endsection
