@extends('layouts.master')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="thumbnail rounden w-25">
                            <img src="{{ asset('dist/img/lazismu.png') }}" alt="">
                        </div>
                        <div class="body ml-3">
                            <h5>Zakat</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore tempore quisquam at ratione reprehenderit voluptates voluptate optio consequuntur nesciunt exercitationem.</p>
                        </div>
                    </div>
                </div>
            <form action="{{ route('zakat.update', $zakat->id) }}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Rp.</h1>
                            <input type="number" value="{{ $zakat->nominal }}"  class="form-control" name="nominal" placeholder="Masukan nominal zakat" value="0">
                        </div>
                        <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Kg.</h1>
                            <input type="number" value="{{ $zakat->nominal_beras }}" class="form-control" name="nominal_beras" placeholder="Masukan nominal zakat" value="0">
                        </div>
                        <p style="color: red">Silakan input jumlah zakat di form yang sudah di sediakan diatas sesuai dengan jenis barang yang di zakatkan ( bisa pilih salah satu/keduanya) </p>
                        <div class="form-group mt-2">
                            <label for="user_id">Donatur</label>
                            <select name="user_id" id="" class="form-control">
                                    <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                            </select>
                            <div class="group">
                                <label for="user_id">Jenis Zakat</label>
                                <select name="jenis_zakat" id="" class="form-control">
                                    <option value="{{ $zakat->jenis_zakat }}">{{ $zakat->jenis_zakat }}</option>
                                </select>
                            </div>
                        </div>
                        <label for="">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="" cols="30" rows="10">{{ $zakat->keterangan }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Lanjutkan pembayaran</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
