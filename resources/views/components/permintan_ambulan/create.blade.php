@extends('layouts.master')
@section('title', 'Buat Permintaan Ambulan')
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
                                <label class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control @error('nama_pasien') is-invalid
                                @enderror" value="{{ old('nama_pasien') }}" name="nama_pasien">
                            @error('nama_pasien')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control @error('jk') is-invalid
                                @enderror" value="{{ old('jk') }}" name="jk">
                            @error('jk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid
                                @enderror" value="{{ old('tanggal') }}" name="tanggal">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Titik Jemput</label>
                                <input type="text" class="form-control @error('titik_jemput') is-invalid
                                @enderror" value="{{ old('titik_jemput') }}" name="titik_jemput">
                            @error('titik_jemput')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tujuan</label>
                                <select type="text" name="rumahsakit_id" class="form-control @error('rumahsakit_id') is-invalid
                                @enderror" value="{{ old('rumahsakit_id') }}" placeholder="Company" value="Chet">
                                    <option value="">-Pilih tujuan--</option>
                                    @foreach ($rumahsakit as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_rs }}</option>
                                    @endforeach
                                </select>
                                @error('rumahsakit_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Infaq</label>
                                <input type="number" class="form-control @error('infaq') is-invalid
                                @enderror" name="infaq" value="0">
                                @error('infaq')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea type="text" id="editor" name="keterangan" class="form-control @error('keterangan') is-invalid
                                @enderror">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm mr-2" style="float:right">Buat Permintaan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
