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
                <button data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-primary my-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Driver</button>
                {{-- <a href="" type="button" class="btn btn-success mt-2 ml-2 btn-sm"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="" type="button" class="btn btn-danger mt-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a> --}}
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>Nama Driver</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($driver as $item)
                            <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                @if ($item->status_driver=='Aktif')
                                <div class="btn btn-outline-success btn-sm">{{ $item->status_driver }}</div>
                                @else
                                <div class="btn btn-outline-danger btn-sm">{{ $item->status_driver }}</div>
                                @endif
                            </td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                <a href="{{ route('driver.destroy', $item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
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
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('driver.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Nama Driver</label>
                        <select type="text" name="user_id" class="form-control">
                            <option value="">--Pilih User--</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Status</label>
                        <select type="text" name="status_driver" class="form-control">
                            <option value="">--Pilih status--</option>
                            <option value="Aktif">Aktiv</option>
                            <option value="Non-Aktif">Non Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" >Tambah Driver</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    @foreach ($driver as $item)
        <div class="modal modal-blur fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Input Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('driver.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label">Nama Driver</label>
                        <select type="text" name="user_id" class="form-control">
                            <option value="{{ $item->user->id }}">{{ $item->user->name }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Status</label>
                        <select type="text" name="status_driver" class="form-control">
                            <option value="">--Pilih status--</option>
                            <option value="Aktif">Aktiv</option>
                            <option value="Non-Aktif">Non Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm" >Simpan</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    @endforeach

@endsection
