@extends('layouts.master')
@section('title', 'Data Permintaan Ambulan')
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
            <div class="card-body">
                @if ($message = Session::get('Success'))
                    <div class="alert alert-success alert-block mb-2">
                        <p><i class="bi bi-check-circle-fill"></i><strong> Berhasi! </strong>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('Update'))
                    <div class="alert alert-primary alert-block mb-2">
                        <p><i class="bi bi-lightbulb-fill"></i><strong> Pemberiahuan! </strong>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('delete'))
                    <div class="alert alert-primary alert-block mb-2">
                        <p><i class="bi bi-lightbulb-fill"></i><strong> Pemberiahuan! </strong>{{ $message }}</p>
                    </div>
                @endif
            <div class="table-responsive">
                @role('administrator')
                    {{-- <a href="{{ route('permintaan.ambulan.create') }}" class="btn btn-primary my-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i> Tambah Permintaan</a> --}}
                    <a href="{{ route('permintaan.ambulan.Pdf') }}" type="button" class="btn btn-danger my-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm"><i class="bi bi-printer-fill"></i> Cetak Pertanggal</button>
                @endrole
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>JK</th>
                            <th>Tanggal</th>
                            <th>Titik Jemput</th>
                            <th>Tujuan</th>
                            <th>Keterangan</th>
                            <th>Infaq (Rp)</th>
                            <th>Status Permintaan</th>
                            <th>Status</th>
                            @role('administrator')
                                    <th>Feedback</th>
                                    <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permintaanAmbulan as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->nama_pasien}}</td>
                            <td>{{ $item->jk}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y')  }}</td>
                            <td>{{ $item->titik_jemput }}</td>
                            <td>{{ $item->rumahsakit->nama_rs }} </td>
                            <td>{!! $item->keterangan !!}</td>
                            <td>{{ number_format($item->infaq , 0, ',', '.') }}</td>
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
                            @elseif ($item->status_id == 5)
                                <div>Mohon maaf, permintaan anda ditolak, kemungkinan masalah jarak dan kelengkapan deskripsi. Mohon periksa kembali.</div>
                            @endif
                            </td>
                            @role('administrator')
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

</div>
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
