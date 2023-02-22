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
                <a href="{{ route('donasi.create') }}" type="button" class="btn btn-primary btn-sm mr-2" style="float: right"><i class="bi bi-plus-square"></i>Tambah donasi</a>
                <a href="{{ route('exportPdf') }} " type="button" class="btn btn-danger my-2 btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i>PDF</a>
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>Nama Donatur</th>
                            <th>No. Rekening</th>
                            <th>Jumlah Donasi (Rp)</th>
                            <th>Program Dipilih</th>
                            <th>Keterangan</th>
                            <th>Status Donasi</th>
                            <th>Status Penyaluran</th>
                            <th>Feedback</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi as $item)
                        <tr>
                            <td>
                                @if ($item->user_id)
                                    {{ $item->user->name }}
                                @else
                                    {{ $item->nama_donatur }}
                                @endif
                            </td>
                            <td>{{ $item->no_rek }}</td>
                            <td>{{ number_format($item->jml_donasi, 0, ',', '.') }}</td>
                            <td>{{ $item->programDonasi->nama_program }}</td>
                            <td>{!! $item->keterangan !!}</td>
                            <td>
                            @if ($item->status_id ==1)
                                <div class="btn btn-outline-danger btn-sm">{{ $item->status->nama_status }}</div>
                            @else
                                <div class="btn btn-outline-success btn-sm">{{ $item->status->nama_status }}</div>
                            @endif
                            </td>
                            <td>
                                @if ($item->status_penyaluran=='Belum Tersalurkan')
                                    <div class="btn btn-outline-danger btn-sm">{{ $item->status_penyaluran }}</div>
                                @else
                                    <div class="btn btn-outline-success btn-sm">{{ $item->status_penyaluran }}</div>
                                @endif
                            </td>
                            <td>
                                @if ($item->status_id==1)
                                    <a href="{{ route('validasi.donasi', $item->id) }}" class="btn btn-success btn-sm">Validasi</a>
                                @else
                                    <a href="{{ route('validasi.donasi', $item->id) }}" class="btn btn-danger btn-sm">Diproses</a>
                                @endif
                                {{-- <a href="{{ route('donasi.salurkan', $item->id) }}" class="btn btn-primary btn-sm" title="Salurkan"><i class="bi bi-box2-heart-fill"></i></a> --}}
                            </td>
                            <td>
                                <a href="{{ route('program.index', ['id' => $item->programDonasi->id, 'id_akun' => $item->akun->id]) }} " class="btn btn-info btn-sm" title="Detile"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('donasi.edit', $item->id) }} " class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('donasi.destroy',$item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        {{ $donasi->links()}}
    </div>
</div>
@endsection
