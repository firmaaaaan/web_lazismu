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
                    <p class="h3"></p>
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
                      <th class="text-center" style="width: 1%">No</th>
                      <th>Program donasi</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>
                        <p class="strong mb-1">{{ $donasi->nama_program }}</p>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($donasi->created_at)->format('d M Y') }}</td>
                        <td>{{ number_format($donasi->jml_donasi, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
                <p class="text-muted text-center mt-5">Terima kasih sudah berdonasi di LAZISMU Banguntapan Selatan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
