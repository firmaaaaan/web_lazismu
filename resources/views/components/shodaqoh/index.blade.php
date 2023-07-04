@extends('layouts.master')
@section('title', 'Data Donasi')
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
            Data Donasi
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
                @role('administrator')
                    <a href="{{ route('donasi.create') }}" type="button" class="btn btn-primary btn-sm mb-2" style="float: right"><i class="bi bi-plus-square"></i> Tambah donasi</a>
                    <a href="{{ route('program.salurkan') }}" class="btn btn-primary btn-sm mb-2 mr-2" style="float: right" title="Salurkan"><i class="bi bi-box2-heart-fill"></i> Salurkan Donasi</a>
                    <a href="{{ route('exportPdf') }} " type="button" class="btn btn-danger mb-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mb-2 btn-sm"><i class="bi bi-printer-fill"></i>Cetak Pertanggal</button>
                @endrole
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Donatur</th>
                            <th>No. Rekening</th>
                            <th>Jumlah Donasi (Rp)</th>
                            <th>Program Dipilih</th>
                            <th>Keterangan</th>
                            <th>Bukti TF</th>
                            <th>Status Donasi</th>
                            @role('administrator')
                                <th>Feedback</th>
                                <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                        @foreach ($donasi as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                @if ($item->id_donatur)
                                    {{ $item->donatur->nama_donatur }}
                                @else
                                    {{ $item->nama_donatur }}
                                @endif
                            </td>
                            <td>{{ $item->no_rek }}</td>
                            <td>{{ number_format($item->jml_donasi, 0, ',', '.') }}</td>
                            <td>{{ $item->programDonasi->akun->nama_akun }} - {{ $item->programDonasi->nama_program }}</td>
                            <td>{!! $item->keterangan !!}</td>
                            <td>
                            <a href="/buktitf/{{ $item->buktiTf }}" target="_blank">
                                @if ($item->buktiTf)
                                <img src="/buktitf/{{ $item->buktiTf }}" alt="Gambar Donasi">
                                @else
                                <span>-</span>
                                @endif
                            </a>
                            </td>
                            <td>
                            @if ($item->status_id ==1)
                                <div class="btn btn-outline-danger btn-sm">{{ $item->status->nama_status }}</div>
                            @else
                                <div class="btn btn-outline-success btn-sm">{{ $item->status->nama_status }}</div>
                            @endif
                            </td>

                            @role('administrator')
                                <td>
                                    @if ($item->status_id==1)
                                        <a href="{{ route('validasi.donasi', $item->id) }}" class="btn btn-success btn-sm">Validasi</a>
                                    @else
                                        <a href="{{ route('validasi.donasi', $item->id) }}" class="btn btn-danger btn-sm">Diproses</a>
                                    @endif
                                    {{-- <a href="{{ route('donasi.salurkan', $item->id) }}" class="btn btn-primary btn-sm" title="Salurkan"><i class="bi bi-box2-heart-fill"></i></a> --}}
                                </td>
                                <td>
                                    {{-- <a href="{{ route('program.index', ['id' => $item->programDonasi->id, 'akun_id' => $item->akun->id]) }} " class="btn btn-info btn-sm" title="Detile"><i class="bi bi-eye"></i></a> --}}
                                    <a href="{{ route('program.index', ['id' => $item->programDonasi->id, 'akun_id' => $item->programDonasi->akun->id]) }}" class="btn btn-info btn-sm" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('donasi.edit', $item->id) }} " class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('donasi.destroy',$item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                    <a href="{{ route('donasi.faktur',$item->id) }}" class="btn btn-warning btn-sm" title="Cetak"><i class="bi bi-printer-fill"></i></a>
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
            <a href="" type="submit" onclick="this.href='/cetak-donasi-pertanggal/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </div>
        </div>
    </div>
</div>
@endsection
