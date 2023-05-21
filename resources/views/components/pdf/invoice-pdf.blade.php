
@extends('layouts.master')
@section('title','Invoice')
@section('content')
<div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Invoice
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                  <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><rect x="7" y="13" width="10" height="8" rx="2"></rect></svg>
                  Print Invoice
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
                <div class="row">
                  <div class="col-6">
                    <p class="h3">Company</p>
                    <address>
                      Street Address<br>
                      State, City<br>
                      Region, Postal Code<br>
                      ltd@example.com
                    </address>
                  </div>
                  <div class="col-6 text-end">
                    <p class="h3">{{ $donasi->nama_donatur }}</p>
                    <address>
                      Street Address<br>
                      State, City<br>
                      Region, Postal Code<br>
                      ctr@example.com
                    </address>
                  </div>
                  <div class="col-12 my-5">
                    <h1>Invoice INV/001/15</h1>
                  </div>
                </div>
                <table class="table table-transparent table-responsive">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 1%"></th>
                      <th>Program donasi</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  @php
                        $no=1;
                    @endphp
                  <tbody>
                     @foreach ($donasi as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>
                        <p class="strong mb-1">{{ $item->nama_program }}</p>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        <td>{{ number_format($item->jml_donasi, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                  you again!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
