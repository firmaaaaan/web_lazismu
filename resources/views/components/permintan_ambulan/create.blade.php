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
            Input Permintaan Ambulan
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('permintaan.ambulan.store') }}" method="POST">
                    @csrf
                    <div class="row row-cards">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Nama Customer</label>
                                <select name="user_id" id="" class="form-control">
                                    <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Titik Jemput</label>
                                <input type="text" class="form-control" name="titik_jemput">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tujuan</label>
                                <select type="text" name="rumahsakit_id" class="form-control" placeholder="Company" value="Chet">
                                    <option value="">-Pilih tujuan--</option>
                                    @foreach ($rumahsakit as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_rs }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 com-md-6">
                            <div class="mb-3">
                                <label class="form-label">Infaq</label>
                                <input type="number" class="form-control" name="infaq" value="0">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" name="keterangan" class="form-control"></textarea>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm" style="float:right">Buat</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
