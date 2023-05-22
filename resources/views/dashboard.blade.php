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
        @role('administrator')
            <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="{{ route('create.transaction') }}" class="btn btn-success btn-sm ml-3"> <i class="bi bi-wallet-fill"></i> Transfer</a>
                            </span>
                            <a href="{{ route('dokumentasi.create') }}" class="btn btn-primary d-none d-sm-inline-block btn-sm ">
                                <i class="bi bi-pencil"></i> Buat Dokumentasi</a>
                                <button type="button" class="btn btn-warning btn-sm" onclick="javascript:window.print();"><i class="bi bi-printer-fill"></i> Cetak Dashboard</button>
                        </div>
                    </div>
        @endrole
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
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="h1 mb-3" style="color: green">Rp.{{ number_format($total_donasi, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <b>TERSALURKAN</b>
                                    <p>Rp.{{ number_format($totalTersalurkan, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <b>TERSISA</b>
                                    <p>Rp.{{ number_format($tersisa, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <h5>Grafik Sisa Saldo Donasi Setiap Program</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Grafik Saldo Donasi Perprogram</h5><br/>
                        <small class="color:red">sebelum disalurkan & dipindahkan</small>
                    </div>
                    <div class="card-body">
                        <canvas id="pie"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Grafik Saldo Donasi Perbulan</h5></div>
                    <div class="mx-3 mt-3 mr">
                        <label for="yearSelect">Pilih Tahun:</label>
                        <select class="form-control" id="yearSelect" onchange="handleYearChange()">
                            <option value="">Semua Tahun</option>
                            @foreach($donationsPerYear as $donation)
                                <option value="{{ $donation->year }}">{{ $donation->year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="monthChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Grafik Saldo Pertahun</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="yearChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('chart')
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');

    // Calculate remaining donation and distributed amounts
    var remainingDonations = [];
    var distributedDonations = [];
    @if($programDonasi)
    @foreach($programDonasi as $donationProgram)
        var remaining = {{ $donationProgram->jumlah_donasi_program }} - {{ $donationProgram->tersalurkan }};
        remainingDonations.push(remaining);
        distributedDonations.push({{ $donationProgram->tersalurkan }});
    @endforeach
    @endif

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
                    label: 'Sisa Saldo',
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
                },
                {
                    label: 'Tersalurkan',
                    data: distributedDonations,
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 1
                }
            ]
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


        <script>
        var ctx = document.getElementById('pie').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
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
                        @if($dataDonasi)
                            @foreach($dataDonasi as $donation)
                                {{ $donation }},
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

    <script>
        var yearLabels = {!! json_encode($donationsPerYear->pluck('year')) !!};
        var yearData = {!! json_encode($donationsPerYear->pluck('total_donations')) !!};

        var yearChart = new Chart(document.getElementById("yearChart"), {
            type: 'bar',
            data: {
                labels: yearLabels,
                datasets: [{
                    label: 'Total Donasi',
                    data: yearData,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var monthChart = null;
        var allMonthLabels = {!! json_encode($donationsPerMonth->map(function ($item) { return $item->year.'-'.$item->month; })) !!};
        var allMonthData = {!! json_encode($donationsPerMonth->pluck('total_donations')) !!};

        function handleYearChange() {
            var selectedYear = document.getElementById("yearSelect").value;
            var filteredMonthLabels = [];
            var filteredMonthData = [];

            if (selectedYear !== "") {
                for (var i = 0; i < allMonthLabels.length; i++) {
                    var year = allMonthLabels[i].split("-")[0];
                    if (year === selectedYear) {
                        filteredMonthLabels.push(allMonthLabels[i]);
                        filteredMonthData.push(allMonthData[i]);
                    }
                }
            } else {
                filteredMonthLabels = allMonthLabels;
                filteredMonthData = allMonthData;
            }

            if (monthChart) {
                monthChart.destroy();
            }

            var ctx = document.getElementById("monthChart").getContext("2d");
            monthChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: filteredMonthLabels,
                    datasets: [{
                        label: 'Total Donasi',
                        data: filteredMonthData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>

@endsection
@endsection
