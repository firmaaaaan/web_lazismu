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
        <div>

            <a href="{{ route('create.transaction') }}" class="btn btn-success btn-sm ml-3"> <i class="bi bi-wallet-fill"></i> Transfer</a>
            <a href="{{ route('dokumentasi.create') }}" class="btn btn-primary btn-sm ml-3"> <i class="bi bi-pencil"></i> Buat Dokumentasi</a>
        </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h2>Total Saldo:</h2>
                        <div class="h1 mb-3" style="color: green">Rp.{{ number_format($total_donasi, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
