@extends('layouts.master')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="thumbnail rounden w-25">
                            <img src="{{ asset('dist/img/lazismu.png') }}" alt="" width="150">
                        </div>
                        <div class="body ml-3">
                            <h2>Donasi</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit maxime quibusdam quis voluptas perferendis voluptates repellat eius voluptate ipsum sunt earum quia, aliquid ipsa consectetur sapiente assumenda doloribus? Voluptatum, alias.</p>
                        </div>
                    </div>
                </div>
            <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Rp.</h1>
                            <input type="number" class="form-control" name="jml_donasi" placeholder="Masukan nominal donasi" value="0">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Donatur</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">No. Rekening</label>
                            <input type="text" name="no_rek" class="form-control" value="" placeholder="Contoh: BSI 1745351819">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Akun yang dipilih</label>
                            <select name="id_akun" id="id_akun" class="form-control">
                                <option value="">--Pilih Akun--</option>
                                @foreach ($akun as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_akun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Program yang dipilih</label>
                            <select name="programdonasi_id" id="programdonasi_id" class="form-control">
                                <option value="">--Pilih Jenis Program--</option>
                                @foreach ($programDonasi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_program }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="">Keterangan</label>
                        <textarea class="form-control" id="editor" name="keterangan" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Lanjutkan pembayaran</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
