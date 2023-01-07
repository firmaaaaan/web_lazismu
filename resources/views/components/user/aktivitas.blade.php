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
            Aktivitas {{ $user->name }}
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        @foreach ($zakat as $item)
            <div class="card mb-2">
            <div class="card-body">
                <p>Terima kasih telah membayar zakat di Lazismu Banguntapan Selatan. Informasi Penyaluran akan terupdate dihalaman ini. </p>
                <p class="mt-0">Jumlah zakat: <b>Rp. {{ number_format( $item->nominal , 0, ",", ".") }}</b></p>
                @if ($item->status_id ==1)
                    <p>Status zakat: <b style="color: red">{{ $item->status->nama_status }}</b></p> <small>Mohon untuk konfirmasi ke admin jika dalam 1x24 jam belum tervalidasi</small>
                @else
                    <p>Status zakat: <b style="color: green">{{ $item->status->nama_status }}</b></p>
                @endif

                @if ($item->status_penyaluran =='Belum Tersalurkan')
                    <p>Status Penyaluran: <b style="color: red">{{ $item->status_penyaluran }}</b></p>
                @else
                    <p>Status Penyaluran: <b style="color: green">{{ $item->status_penyaluran }}</b></p>
                    <small>Tersalurkan :  </small>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
