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
            <div class="table-responsive">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary my-2 mr-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i>Tambah Akun</button>
                <table class="table" id="tdatatables">
                    <thead>
                        <tr>
                            <th>Kode </th>
                            <th>Nama Akun</th>
                            <th>Persen Hak Amil</th>
                            <th>Saldo Awal</th>
                            <th>Dipindahkan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akun as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama_akun }}</td>
                            <td>{{ $item->persen_hak_amil }}</td>
                            <td>{{ $item->saldo_awal }}</td>
                            <td>{{ $item->dipindahkan }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#example{{ $item->id }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                <a href="{{ route('akun.delete',$item->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
                            <input type="text" class="form-control" name="kode">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Nama Akun</label>
                            <input type="text" class="form-control" name="nama_akun">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Pesen hak amil</label>
                            <input type="text" name="persen_hak_amil" class="form-control">
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
                            <input type="text" value="{{ $item->kode }}" class="form-control" name="kode">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Nama Akun</label>
                            <input type="text" value="{{ $item->nama_akun }}" class="form-control" name="nama_akun">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Pesen hak amil</label>
                            <input type="text" value="{{ $item->persen_hak_amil }}" name="persen_hak_amil" class="form-control">
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
@endforeach
@endsection
