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
            Dashboard
            </h2>
        </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                        <div class="subheader">Account</div>
                        </div>
                        <div class="h2 mb-3">Rp.{{ number_format($total_donasi, 0, ',', '.') }}</div>
                        <div class="d-flex mb-2">
                        <div>Total donasi</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                        <div class="subheader">Account</div>
                        </div>
                        <div class="h2 mb-3">Rp.{{ number_format($total_tersalurkan, 0, ',', '.') }} </div>
                        <div class="d-flex mb-2">
                        <div>Donasi Tersalurkan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                        <div class="subheader">Account</div>
                        </div>
                        <div class="h2 mb-3">Rp.{{ number_format($total_tersisa, 0, ',', '.') }}</div>
                        <div class="d-flex mb-2">
                        <div>Donasi Tersisa</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-deck row-cards mt-2">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                        <div class="subheader">Account</div>
                        </div>
                        <div class="h2 mb-3">Rp.{{ number_format($total_zakat, 0, ',', '.') }}</div>
                        <div class="d-flex mb-2">
                        <div>Total Zakat</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                        <div class="subheader">Account</div>
                        </div>
                        <div class="h2 mb-3">Rp.{{ number_format($zakat_tersalurkan, 0, ',', '.') }}</div>
                        <div class="d-flex mb-2">
                        <div>Zakat Tersalurkan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                        <div class="subheader">Account</div>
                        </div>
                        <div class="h2 mb-3">Rp.{{ number_format($total_zakat_tersisa, 0, ',', '.') }}</div>
                        <div class="d-flex mb-2">
                        <div>Zakat Tersisa</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-3">
        <h2 style="text-align: center">Program Lazismu Banguntapan selatan</h2>
        <div class="row">
        @foreach ($programDonasi as $item)
        <div class="col-sm-6 col-lg-2">
                <a href="{{ route('program.donasi.show', $item->id) }}" style="text-decoration: none; color:black">
                <div class="card">
                    <div class="card-body">
                        <div> <img src="/images/{{ $item->foto }}" alt="" width="150">
                            <div class="card-title">{{ $item->nama_program }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
