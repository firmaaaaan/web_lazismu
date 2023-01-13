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
                <form action="{{ route('store.transaction') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <label for="id_programdonasi_asal">Program Donasi Asal</label>
                        <select name="id_programdonasi_asal" id="id_programdonasi_asal" class="form-control">
                            <option value="">--Pilih Program Donasi Awal--</option>
                            @foreach($programDonasi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_programdonasi_tujuan">Program Donasi Tujuan</label>
                        <select name="id_programdonasi_tujuan" id="id_programdonasi_tujuan" class="form-control">
                            <option value="">--Pilih Program Donasi Awal--</option>
                            @foreach($programDonasi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Rp.</h1>
                            <input type="number" class="form-control" name="nominal" placeholder="Masukan nominal donasi" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Transfer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
