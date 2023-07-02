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
            Data Akun
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
                            <div class="alert alert-info alert-block mb-2">
                                <p><i class="bi bi-lightbulb-fill"></i><strong> Pemberitahuan! </strong>{{ $message }}</p>
                            </div>
                @endif
            <div class="table-responsive">
                @role('administrator')
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary my-2 mr-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Akun</button>
                @endrole
                <table class="table" id="tdatatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode </th>
                            <th>Nama Akun</th>
                            <th>Persen Hak Amil</th>
                            @role('administrator')
                                <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach ($akun as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama_akun }}</td>
                            <td>{{ $item->persen_hak_amil }}</td>
                            @role('administrator')
                                <td>
                                    <a href="{{ route('akun.programDonasi',$item->id) }}" class="btn btn-info btn-sm" title="Detile"><i class="bi bi-eye"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#example{{ $item->id }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#deleted{{ $item->id }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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
            <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Kode</label>
                            <input type="text" class="form-control @error('kode') is-invalid
                            @enderror" value="{{ old('kode') }}" name="kode">
                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">Nama Akun</label>
                            <input type="text" class="form-control @error('nama_akun') is-invalid
                            @enderror" value="{{ old('nama_akun') }}" name="nama_akun">
                            @error('nama_akun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">Persen hak amil</label>
                            <input type="text" name="persen_hak_amil" class="form-control @error('persen_hak_amil') is-invalid
                            @enderror" value="{{ old('persen_hak_amil') }}">
                            @error('persen_hak_amil')
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
@foreach ($akun as $item)
<div class="modal fade" id="example{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Input data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('akun.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Kode</label>
                            <input type="text" value="{{ $item->kode }}" class="form-control @error('kode') is-invalid
                            @enderror" value="{{ old('kode') }}" name="kode">
                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">Nama Akun</label>
                            <input type="text" value="{{ $item->nama_akun }}" class="form-control @error('nama_akun') is-invalid
                            @enderror" value="{{ old('nama_akun') }}" name="nama_akun">
                        @error('nama_akun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">Persen hak amil</label>
                            <input type="text" value="{{ $item->persen_hak_amil }}" name="persen_hak_amil" class="form-control @error('persen_hak_amil') is-invalid
                            @enderror" value="{{ old('persen_hak_amil') }}">
                        @error('persen_hak_amil')
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

@foreach ($akun as $it)
    <div class="modal fade" id="deleted{{ $it->id }}" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apa anda yakin?</div>
                <div>Jika Akun {{ $it->nama_akun }} dihapus maka program donasi dan donasi yang terkait akan terhapus permanen.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <a href="{{ route('akun.delete', $item->id) }}"  class="btn btn-danger btn-sm">Iya, hapus akun</a>
            </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
