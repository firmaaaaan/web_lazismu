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
            Data Permintaan Ambulan
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="table-responsive">
                <a href="{{ route('permintaan.ambulan.create') }}" class="btn btn-primary my-2 mx-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Permintaan</a>
                <a href="" type="button" class="btn btn-success mt-2 ml-2 btn-sm"><i class="bi bi-file-earmark-excel-fill"></i>Excel</a>
                <a href="{{ route('permintaan.ambulan.Pdf') }}" type="button" class="btn btn-danger mt-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mt-2 btn-sm"><i class="bi bi-printer-fill"></i>Cetak Pertanggal</button>
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Tanggal</th>
                            <th>Titik Jemput</th>
                            <th>Tujuan</th>
                            <th>Keterangan</th>
                            <th>Infaq</th>
                            <th>Status Permintaan</th>
                            <th>Status Perjalanan</th>
                            <th>Feedback</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($permintaanAmbulan as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->titik_jemput }}</td>
                            <td>{{ $item->rumahsakit->nama_rs }} </td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->infaq }}</td>
                            <td>
                                @if ($item->status_id ==3)
                                    <div class="btn btn-outline-primary btn-sm">{{ $item->status->nama_status }} </div>
                                @elseif ($item->status_id ==4)
                                    <div class="btn btn-outline-success btn-sm">{{ $item->status->nama_status }} </div>
                                @else
                                    <div class="btn btn-outline-danger btn-sm">{{ $item->status->nama_status }} </div>
                                @endif
                            </td>
                            <td>
                            @if ($item->status_id == 4)
                                <div class="btn btn-outline-success btn-sm">{{ $item->status_perjalanan }}</div>
                            @endif
                            </td>
                            <td>
                                @if ($item->status_id==4)
                                    <a href="{{ route('validasi.ambulan', $item->id) }}" class="btn btn-danger btn-sm" title="Ditolak"><i class="bi bi-exclamation-circle"></i></a>
                                @else
                                    <a href="{{ route('validasi.ambulan', $item->id) }}" class="btn btn-success btn-sm" title="Diterima"><i class="bi bi-check2-square"></i></a>
                                @endif
                                <form method="POST" action="{{ route('perjalanan.updateStatus', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status_perjalanan" class="btn btn-primary btn-sm" value="Selesai" title="Selesai"><i class="bi bi-check2-all"></i></button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('permintaan.ambulan.edit', $item->id)}}" class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('permintaan.ambulan.destroy', $item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $permintaanAmbulan->links() }}
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cetak Permintaan Ambulan Pertanggal</h5>
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
            <a href="" type="submit" onclick="this.href='/cetak-pertanggal/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </div>
        </div>
    </div>
    </div>
@endsection
