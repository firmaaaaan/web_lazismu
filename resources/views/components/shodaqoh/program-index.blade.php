@extends('layouts.master')
@section('title', 'Donasi Perprogram')
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
            Data {{ $programDonasi->nama_program }}
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row mb-2">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <strong> DONASI TERKUMPUL : Rp.{{ number_format($totalDonationForProgram, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <strong> DONASI TERSALURKAN : Rp.{{ number_format($programDonasi->tersalurkan, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <strong>SISA DONASI : Rp.{{ number_format($programDonasi->jumlah_donasi_program , 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <strong>HAK AMIL : Rp.{{ number_format($total_hak_amil , 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                @if ($message = Session::get('belum'))
                        <div class="alert alert-danger alert-block mb-2">
                            <p><i class="bi bi-backspace-reverse-fill"></i>{{ $message }}</p>
                        </div>
                    @endif
                @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block mb-2">
                            <p><i class="bi bi-backspace-reverse-fill"></i>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block mb-2">
                            <p><i class="bi bi-check-circle-fill"></i>{{ $message }}</p>
                        </div>
                    @endif
            <div class="table-responsive">
                {{-- <a href="{{ route('donasi.Programsalurkan', ['id' => $programDonasi->id, 'akun_id' => $akun->id]) }}" class="btn btn-primary btn-sm mb-2" title="Salurkan"><i class="bi bi-box2-heart-fill"></i>Salurkan Donasi</a> --}}
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm mb-2" title="Cetak Pertanggal"><i class="bi bi-printer-fill"></i>Cetak Pertanggal</button>
                <table class="table" id="table-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Donatur</th>
                            <th>No. Rekening</th>
                            <th>Jumlah Donasi</th>
                            <th>Keterangan</th>
                            <th>Status Donasi</th>
                            <th>Tanggal</th>
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
                            <td>{!! $item->keterangan !!} </td>
                            <td>
                            @if ($item->status_id ==1)
                                <div class="btn btn-outline-danger btn-sm">{{ $item->status->nama_status }}</div>
                            @else
                                <div class="btn btn-outline-success btn-sm">{{ $item->status->nama_status }}</div>
                            @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
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
            <form method="GET" action="">
                {{-- <div class="form-group">
                    <label for="akunId">Akun:</label>
                    <select name="id_akun" id="akunId" class="form-control" required>
                        <option value="{{ $akun->id }}" disabled selected>{{ $akun->nama_akun }}</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="programId">Program Donasi:</label>
                    <select name="programdonasi_id" id="programId" class="form-control" required>
                        <option value="{{ $programDonasi->id }}" disabled selected>{{ $programDonasi->nama_akun }}{{ $programDonasi->nama_program }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tglAwal">Tanggal Awal:</label>
                    <input type="date" name="tglAwal" id="tglAwal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tglAkhir">Tanggal Akhir:</label>
                    <input type="date" name="tglAkhir" id="tglAkhir" class="form-control" required>
                </div>
                {{-- <button type="submit" class="btn btn-primary btn-sm">Cetak Laporan</button> --}}
                {{-- <a href="" type="submit" onclick="this.href='/cetak-program-dan-akun-pertanggal/{{ 'programId'=>$programDonasi->id }}/{{ 'akunId'=>$akun->id }}'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a> --}}
            {{-- <a href="{{ route('cetak.program-akun-pertanggal', ['programId' => $programDonasi->id, 'akunId' => $akun->id, 'tglAwal' => 'tglAwal', 'tglAkhir' => 'tglAkhir']) }}"+ document.getElementById('tglAwal').value +"/"+ document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a> --}}
            <a href="" type="submit" onclick="this.href='/cetak-program-dan-akun-pertanggal/{{ $programDonasi->id }}/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </form>
        </div>
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            <a href="" type="submit" onclick="this.href='/cetak-donasi-program/{{ $programDonasi->id }}/pertanggal/'+document.getElementById('tglAwal').value+'/'+document.getElementById('tglAkhir').value" target="_blank" class="btn btn-primary btn-sm">Cetak Pertanggal</a>
        </div> --}}
        </div>
    </div>
</div>
@endsection
