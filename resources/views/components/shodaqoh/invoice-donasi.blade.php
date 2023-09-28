@extends('layouts.master')
@section('title','Invoice')
@section('content')
@section('style')
 <style>
    @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

a {
  color: #0087C3;
  text-decoration: none;
}

.header {
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}
#logo {
  float: left;
  margin-top: 6px;
  margin-bottom: 6px
}

#logo img {
  height: 100px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
    padding-left: 6px;
    text-align: center;
}

#notices .notice {
  font-size: 1.2em;
}
.card{
    padding-right: 2cm;
    padding-left: 2cm;
    padding-top: 2cm;
    padding-bottom: 2cm;
}
</style>
@endsection
@section('content')
        <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                        Cetak Faktur
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                        <i class="bi bi-printer"></i>
                        Cetak Faktur
                        </button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                <div class="container-xl">
                    <div class="card card-lg">
                    <div class="card-body">
        <div class="header clearfix">
            <div id="logo">
                <img src="{{ asset('dist/img/lazis.png') }}"  alt="Lazismu" class="navbar-brand-image">
            </div>
            <div id="company">
                <h2 class="name">KL LAZISMU Banguntapan Selatan</h2>
                <div> Jl. Pleret, Bintaran, Jambidan, Kec. Banguntapan, Kabupaten Bantul,</div>
                <div>Daerah Istimewa Yogyakarta 55194</div>
                <div>0857-4387-2869</div>
            </div>
        </div>
            <main class="main">
            <div id="details" class="clearfix">
                <div id="client">
                <div class="to">FAKTUR:</div>
                <h2 class="name">
                    @if ($donasi->donatur)
                        {{ $donasi->donatur->nama_donatur }}
                    @else
                        {{ $donasi->nama_donatur }}
                    @endif

                </h2>
                {{-- <div class="address">{{ $donasi->donatur->no_hp }}</div> --}}
                <div class="email">
                  <div class="address">-</div>
                    @if ($donasi->donatur)
                        {{ $donasi->donatur->email }}
                    @else
                        <span>-</span>
                    @endif
                </div>
                </div>
                <div id="invoice">
                <div class="date">{{ \Carbon\Carbon::parse($today)->format('d M Y') }}</div>
                <div class="date">Tanggal Berakhir Faktur: {{ \Carbon\Carbon::parse($thirtyDaysAhead)->format('d M Y') }}</div> 
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>

                        <th >PROGRAM DONASI</th>
                        <th >TANGGAL</th>
                        <th >JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $donasi->programDonasi->nama_program }}</td>
                        <td>{{ \Carbon\Carbon::parse($donasi->created_at)->format('d M Y') }}</td>
                        <td>{{ number_format($donasi->jml_donasi, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            <div id="thanks"></div>
            <div id="notices">
                <div class="notice">Terima kasih sudah mempercayakan donasi anda ke Lazismu Banguntapan Selatan</div>
            </div>
            </main>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>
@endsection
