@extends('layouts.master')
@section('title','Invoice')
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
                        Faktur
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><rect x="7" y="13" width="10" height="8" rx="2"></rect></svg>
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
                <h2 class="name">{{ $donatur->nama_donatur }}</h2>
                <div class="address">{{ $donatur->alamat }}</div>
                <div class="email"><a href="{{ $donatur->email }}">{{ $donatur->email }}</a></div>
                </div>
                <div id="invoice">
                <div class="date">{{ \Carbon\Carbon::parse($today)->format('d M Y') }}</div>
                {{-- <div class="date">Tanggal Berakhir Faktur: {{ \Carbon\Carbon::parse($futureDate)->format('d M Y') }}</div> --}}
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th >NO</th>
                        <th >PROGRAM DONASI</th>
                        <th >TANGGAL</th>
                        <th >JUMLAH</th>
                    </tr>
                </thead>
                @php
                $no=1;
                @endphp
                <tbody>
                    @foreach ($donasi as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_program }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        <td>{{ number_format($item->jml_donasi, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"> TOTAL</td>
                    <td colspan="2">{{ number_format($totalDonasi, 0, ',', '.') }}</td>
                </tr>
                </tfoot>
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
