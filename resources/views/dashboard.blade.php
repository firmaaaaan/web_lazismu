@extends('layouts.master')
@section('title','Dashboard')
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
        <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="{{ route('create.transaction') }}" class="btn btn-success btn-sm ml-3"> <i class="bi bi-wallet-fill"></i> Transfer</a>
                        </span>
                        <a href="{{ route('dokumentasi.create') }}" class="btn btn-primary d-none d-sm-inline-block btn-sm">
                            <i class="bi bi-pencil"></i> Buat Dokumentasi</a>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Total Saldo:</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="h1 mb-3" style="color: green">Rp.{{ number_format($total_donasi, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Program Donasi</h5>
                    </div>
                    <div class="card-body overflow-auto" style="max-height: 200px;">
                        @foreach ($programDonasi as $item)
                        <a href="{{ route('program.donasi.show', ['id_akun' => $item->id_akun, 'programdonasi_id' => $item->id]) }}" style="text-decoration: none; color:black">
                            <div class="card mb-2" >
                                <div class="card-body">
                                    <i class="bi bi-box2-heart-fill"></i> {{ $item->nama_program }}
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Grafik Total Donasi Setiap Program</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('chart')
            <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: [
                    @if($programDonasi)
                    @foreach($programDonasi as $donationProgram)
                        '{{ $donationProgram->nama_program }}',
                    @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'Jumlah Donasi',
                    data: [
                    @if($programDonasi)
                        @foreach($programDonasi as $donationProgram)
                        {{ $donationProgram->jumlah_donasi_program }},
                        @endforeach
                    @endif
                    ],
                    backgroundColor: [
                    @if($programDonasi)
                        @foreach($programDonasi as $donationProgram)
                        'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                        @endforeach
                    @endif
                    ],
                    borderColor: [
                    @if($programDonasi)
                        @foreach($programDonasi as $donationProgram)
                        'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)',
                        @endforeach
                    @endif
                    ],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                    }]
                }
                }
            });
        </script>
@endsection
@endsection
