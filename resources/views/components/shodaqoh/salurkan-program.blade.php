@extends('layouts.master')
@section('title', 'Penyaluran Perprogram')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block mb-2">
                                <p><i class="bi bi-check-circle-fill"></i><strong> Penyaluran Berhasil! </strong>{{ $message }}</p>
                            </div>
                @endif
                @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block mb-2">
                                <p><i class="bi bi-backspace-reverse-fill"></i></i><strong> Penyaluran Gagal! </strong>{{ $message }}</p>
                            </div>
                @endif
                @if ($message = Session::get('belum'))
                            <div class="alert alert-info alert-block mb-2">
                                <p><i class="bi bi-lightbulb-fill"></i> <strong> Penyaluran Bermasalah! </strong>{{ $message }}</p>
                            </div>
                        @endif
                <div class="card">

                    <div class="card-body d-flex">
                        <div class="thumbnail rounden w-25">
                            <img src="{{ asset('dist/img/lazismu.png') }}" alt="">
                        </div>
                        <div class="body ml-3">
                            <h5>Salurkan Donasi</h5>
                            <p>“ <i>Dari Abu Bakar Ash-Shiddiq ia berkata, Rasulullah SAW bersabda:</i> Wajib atasmu berlaku jujur, karena jujur itu bersama kebaikan, dan keduanya di Surga. Dan jauhkanlah dirimu dari dusta, Karena dusta itu bersama kedurhakaan, dan keduanya di neraka”.</p>
                        </div>
                    </div>
                </div>
            <form action="{{ route('donasi.storeSalurkanProgram', $donasi->programDonasi->id) }}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                            <input type="hidden" name="id" class="form-control" id="id" value="{{ $donasi->id }}">
                            <label for="">Program yang dipilih</label>
                            <select name="programdonasi_id" id="" class="form-control mb-2">
                                <option value="{{ $donasi->programDonasi->id }}">{{ $donasi->programDonasi->nama_program }}</option>
                            </select>
                        <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Rp.</h1>
                            <input type="number" class="form-control" name="tersalurkan" id="id">
                        </div>
                        <label for="">Disalurkan ke:</label>
                        <textarea name="desk_penyaluran" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Salurkan</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
