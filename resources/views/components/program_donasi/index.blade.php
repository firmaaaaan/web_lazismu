@extends('layouts.master')
@section('title', 'Data Program Donasi')
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
                        <p><i class="bi bi-check-circle-fill"></i> <strong>Berhasil!</strong> {{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('delete'))
                    <div class="alert alert-primary alert-block mb-2">
                        <p><i class="bi bi-lightbulb-fill"></i> <strong>Pemberitahuan!</strong> {{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('Update'))
                    <div class="alert alert-primary alert-block mb-2">
                        <p><i class="bi bi-lightbulb-fill"></i> <strong> Pemberitahuan!</strong> {{ $message }}</p>
                    </div>
                @endif
            <div class="table-responsive">
                @role('administrator')
                    <button data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-primary my-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Program</button>
                @endrole
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm mb-2" title="Cetak Pertanggal"><i class="bi bi-printer-fill"></i> Cetak Pertanggal</button>
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program</th>
                            <th>Deskripsi Program</th>
                            <th>Tersalurkan (Rp)</th>
                            <th>Sisa Donasi (Rp)</th>
                            @role('administrator')
                                <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach ($programDonasi as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_program }}</td>
                            <td>{!! $item->deskripsi !!}</td>
                            <td>{{ number_format($item->tersalurkan , 0, ',', '.') }}</td>
                            <td>{{ number_format($item->jumlah_donasi_program , 0, ',', '.') }}</td>
                            @role('administrator')
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-primary btn-sm"" title="Edit"><i class="bi bi-pencil-square"></i></button>
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
                        <label for="">Nama Akun</label>
                        <select name="id_akun" id="" class="form-control @error('id_akun') is-invalid
                        @enderror">
                            <option value="">--Pilih Akun--</option>
                            @foreach ($akun as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_akun }}</option>
                            @endforeach
                        </select>
                        @error('id_akun')
                            <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Nama Program Donasi</label>
                        <input type="text" name="nama_program" class="form-control @error('nama_program') is-invalid
                        @enderror" value="{{ old('nama_program') }}">
                        @error('nama_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Deskripsi</label>
                        <textarea type="date" id="editor" name="deskripsi" class="form-control @error('deskripsi') is-invalid
                        @enderror" value="">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
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
                        <label class="form-label">Nama Program Donasi</label>
                        <input type="text" name="nama_program" class="form-control @error('nama_program') is-invalid
                        @enderror" value="{{ $item->nama_program }}">
                        @error('nama_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Deskripsi</label>
                        <textarea type="date" id="editor" name="deskripsi" class="form-control @error('deskripsi') is-invalid
                        @enderror" value="">{!! $item->deskripsi !!}</textarea>
                    @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
@foreach ($programDonasi as $item)
    @foreach ($akun as $it)
    <div class="modal fade" id="deleted{{ $item->id }}" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apa anda yakin?</div>
                <div>Jika Program {{ $item->nama_program }} dihapus maka donasi yang terkait akan terhapus permanen.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <a href="{{ route('program.donasi.destroy', $item->id) }}"  class="btn btn-danger btn-sm">Iya, hapus Program</a>
            </div>
            </div>
        </div>
    </div>
@endforeach
@endforeach
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cetak Donasi Pertanggal</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <label for="">Tanggal Awal</label>
                <input type="date" name="tglAwal" id="tglAwal" class="form-control">
                <label for="">Tanggal Akhir</label>
                <input type="date" name="tglAkhir" id="tglAkhir" class="form-control">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            <a href="" type="submit" onclick="this.href='/cetak-program-donasi-pertanggal/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </div>
        </div>
    </div>
</div>
@endsection
