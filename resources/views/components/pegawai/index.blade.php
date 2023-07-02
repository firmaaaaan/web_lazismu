@extends('layouts.master')
@section('title', 'Data Karyawan')
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
            Data Pegawai
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('Success'))
                    <div class="alert alert-success alert-block mb-2">
                        <p><i class="bi bi-check-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('Update'))
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
                    <button data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-primary my-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Karyawan</button>
                @endrole
                {{-- <a href="" type="button" class="btn btn-success mt-2 ml-2 btn-sm"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="" type="button" class="btn btn-danger mt-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a> --}}
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>No. Handphone</th>
                            <th>Tanggal Mulai Kerja</th>
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
                        @foreach ($karyawans as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_karyawan }}</td>
                            <td>{{ $item->tmpt_lahir }}</td>
                            <td>{{ $item->tgl_lahir }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->tgl_kerja }}</td>
                            <td>{{ $item->alamat }}</td>
                            @role('administrator')
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                    <a href="{{ route('pegawai.destroy',$item->id ) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
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

    <div class="modal modal-blur fade" id="modal-team" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Input Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid
                        @enderror" value="{{ old('nama_karyawan') }}">
                        @error('nama_karyawan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tmpt_lahir" class="form-control @error('tmpt_lahir') is-invalid
                        @enderror" value="{{ old('tmpt_lahir') }}">
                        @error('tmpt_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid
                        @enderror" value="{{ old('tgl_lahir') }}">
                        @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">No. Handphone</label>
                        <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid
                        @enderror" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid
                        @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Tanggal Mulai bekerja</label>
                        <input type="date" name="tgl_kerja" class="form-control @error('tgl_kerja') is-invalid
                        @enderror" value="{{ old('tgl_kerja') }}">
                        @error('tgl_kerja')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm" >Tambah Karyawan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    @foreach ($karyawans as $item)
<!-- Modal -->
    <div class="modal modal-blur fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Input Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pegawai.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" value="{{ $item->nama_karyawan }}"  name="nama_karyawan" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" value="{{ $item->tmpt_lahir }}" name="tmpt_lahir" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" value="{{ $item->tgl_lahir }}" name="tgl_lahir" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">No. Handphone</label>
                        <input type="number" value="{{ $item->no_hp }}" name="no_hp" class="form-control">
                    </div>
                    <div>
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control">{{ $item->alamat }}</textarea>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Mulai bekerja</label>
                        <input type="date" value="{{ $item->tgl_kerja }}" name="tgl_kerja" class="form-control">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-sm" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach

@endsection
