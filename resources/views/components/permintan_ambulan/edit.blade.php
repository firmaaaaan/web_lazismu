@extends('layouts.master')
@section('title', 'Edit Permintaan Ambulan')
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
                <form action="{{ route('permintaan.ambulan.update', $permintaanAmbulan->id) }}" method="POST">
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
                                <label class="form-label">Nama Pasien</label>
                                <input type="text" value="{{ $permintaanAmbulan->nama_pasien }}" class="form-control" name="nama_pasien">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Nama Pasien</label>
                                <input type="text" value="{{ $permintaanAmbulan->jk }}" class="form-control" name="jk">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" value="{{ $permintaanAmbulan->tanggal }}" class="form-control" name="tanggal">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Titik Jemput</label>
                                <input type="text" class="form-control" value="{{ $permintaanAmbulan->titik_jemput }}" name="titik_jemput">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tujuan</label>
                                <select name="rumahsakit_id" class="form-control" id="">
                                    @foreach ($rumahsakit as $item)
                                    <option value="{{ $item->id }}"@if ($item->id == $item->rumahsakit_id) selected
                                    @endif>{{ $item->nama_rs }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Infaq</label>
                                <input type="number" value="{{ $permintaanAmbulan->infaq }}" class="form-control" name="infaq" value="0">
                            </div>
                        </div>
                        <div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea type="text" id="editor" name="keterangan" class="form-control"> {!! $permintaanAmbulan->keterangan !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success btn-sm ml-2" style="float:right">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
