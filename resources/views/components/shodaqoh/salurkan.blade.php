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
                            <h5>Salurkan Donasi</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore tempore quisquam at ratione reprehenderit voluptates voluptate optio consequuntur nesciunt exercitationem.</p>
                        </div>
                    </div>
                </div>
            <form action="{{ route('donasi.storeSalurkan', $donasi->id) }}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                            <input type="hidden" name="id" class="form-control" id="id" value="{{ $donasi->id }}">
                        <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Rp.</h1>
                            <input type="number" class="form-control" name="donasi_tersalurkan" id="id">
                        </div>
                        <label for="">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="" cols="30" rows="10">{{ $donasi->keterangan }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Salurkan</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
