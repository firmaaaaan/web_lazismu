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
            Export Data Zakat
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive my-2">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary my-2 btn-sm"><i class="bi bi-printer-fill"></i>Cetak Pertanggal</button>
                    <table class="table" id="table-datatables">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Jumlah (Rp)</th>
                                <th>Jumlah (Kg)</th>
                                <th>Jenis Zakat</th>
                                <th>Keterangan</th>
                                <th>Status Penyaluran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zakat as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->nominal }}</td>
                                <td>{{ $item->nominal_beras }}</td>
                                <td>{{ $item->jenis_zakat }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    @if ($item->status_penyaluran =='Belum Tersalurkan')
                                        <div class="btn btn-outline-danger btn-sm">{{ $item->status_penyaluran }}</div>
                                    @else
                                        <div class="btn btn-outline-success btn-sm">{{ $item->status_penyaluran }}</div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $zakat->links() }}
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cetak Zakat Pertanggal</h5>
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
            <a href="" type="submit" onclick="this.href='/cetak-zakat-pertanggal/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </div>
        </div>
    </div>
</div>
@endsection
