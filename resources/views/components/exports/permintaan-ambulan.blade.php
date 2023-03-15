@extends('layouts.master')
@section('title', 'Report Permintaan Ambulan')
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
            Export Data Permintaan Ambulan
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
            <div class="table-responsive">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary my-2 btn-sm"><i class="bi bi-printer-fill"></i>Cetak Pertanggal</button>
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Tanggal</th>
                            <th>Titik Jemput</th>
                            <th>Tujuan</th>
                            <th>Keterangan</th>
                            <th>Infaq (Rp)</th>
                            <th>Status Permintaan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($permintaanAmbulan as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->nama_pasien }}</td>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        {{ $permintaanAmbulan->links() }}
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
