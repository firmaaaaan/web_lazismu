@extends('layouts.master')
@section('title', 'Edit Donasi')
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
                            <h2>Edit Donasi</h2>
                            <p>"Dan belanjakanlah (harta bendamu) di jalan Allah, dan janganlah kamu menjatuhkan dirimu sendiri ke dalam kebinasaan, dan berbuat baiklah, karena sesungguhnya Allah menyukai orang-orang yang berbuat baik." <i>(QS. Al-Baqarah:195)</i></p>
                        </div>
                    </div>
                </div>
            <form action="{{ route('donasi.update', $donasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Rp.</h1>
                            <input type="number" value="{{ $donasi->jml_donasi }}" class="form-control" name="jml_donasi" placeholder="Masukan nominal donasi" value="0">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Donatur</label>
                            <select name="user_id" id="" class="form-control select2">
                                {{-- <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option> --}}
                                <option value="">--Cari Donatur--</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Donatur</label> <small style="color: red">*Jika donatur tidak ada (Opsional)</small>
                            <input type="text" value="{{ $donasi->nama_donatur }}" class="form-control" name="nama_donatur">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Program yang dipilih</label>
                            <select name="programdonasi_id" id="programdonasi_id" class="form-control">
                                <option value="">--Pilih Jenis Program--</option>
                                @foreach ($programDonasi as $item)
                                <option value="{{ $item->id }}"@if ($item->id == $donasi->programdonasi_id) selected
                                @endif>{{ $item->nama_akun }}-{{ $item->nama_program }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">No. Rekening</label>
                            <input type="text" value="{{ $donasi->no_rek }}" name="no_rek" class="form-control" value="" placeholder="Contoh: BSI 1745351819">
                        </div>
                        <label for="">Keterangan</label>
                        <textarea class="form-control" id="editor" name="keterangan" id="" cols="30" rows="10">{{ $donasi->keterangan }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3 btn-sm">Lanjutkan pembayaran</button>
            </form>
            </div>
        </div>
    </div>
</div>
@section('select')
    <script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
@endsection
