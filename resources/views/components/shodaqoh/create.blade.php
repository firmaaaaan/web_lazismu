@extends('layouts.master')
@section('title', 'Buat Donasi')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if ($message = Session::get('sukses'))
                    <div class="alert alert-success alert-block mb-2">
                        <p><i class="bi bi-check-circle-fill"></i><strong> Donasi Berhasil! </strong>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="thumbnail rounden w-25">
                            <img src="{{ asset('dist/img/lazismu.png') }}" alt="" width="150">
                        </div>
                        <div class="body ml-3">
                            <h2>Donasi</h2>
                            <p>"Dan belanjakanlah (harta bendamu) di jalan Allah, dan janganlah kamu menjatuhkan dirimu sendiri ke dalam kebinasaan, dan berbuat baiklah, karena sesungguhnya Allah menyukai orang-orang yang berbuat baik." <i>(QS. Al-Baqarah:195)</i></p>
                        </div>
                    </div>
                </div>
            <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="bg-light rounded d-flex align items center p-3">
                            <h1 class="font-weight-bold w-25">Rp.</h1>
                            <input type="number" class="form-control @error('jml_donasi') is-invalid
                            @enderror" value="{{ old('jml_donasi') }}" name="jml_donasi" placeholder="Masukan nominal donasi" value="0">
                        @error('jml_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                            <input type="text" value="" class="form-control" name="nama_donatur">
                        </div>
                        <div class="form-group">
                            <label for="user_id">No. Rekening</label> <small style="color:red">*Contoh: BSI 12345678 an Firmansyah (opsional)</small>
                            <input type="text" name="no_rek" class="form-control @error('no_rek') is-invalid
                            @enderror" value="{{ old('no_rek') }}">
                        @error('no_rek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        {{-- <div class="row">
                                <div class="col-md-3">
                                    <label for="">Nama Bank</label>
                                    <input type="text" class="form-control" name="nama_bank">
                                </div>
                                <div class="col-md-5">
                                    <label for="user_id">No. Rekening</label>
                                    <input type="text" name="no_rek" class="form-control @error('no_rek') is-invalid
                                    @enderror" value="{{ old('no_rek') }}" placeholder="Contoh: BSI 1745351819">
                                @error('no_rek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for=""> Pemilik Rekening</label>
                                    <input type="text" class="form-control" name="pemilik_rekening">
                                </div>
                            </div> --}}
                        </div>
                        <div class="form-group">
                            <label for="user_id">Akun yang dipilih</label>
                            <select name="id_akun" id="id_akun" class="form-control @error('id_akun') is-invalid
                            @enderror" value="{{ old('id_akun') }}">
                                <option value="">--Pilih Akun--</option>
                                @foreach ($akun as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_akun }}</option>
                                @endforeach
                            </select>
                        @error('id_akun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">Program yang dipilih</label>
                            <select name="programdonasi_id" id="programdonasi_id" class="form-control @error('programdonasi_id') is-invalid
                            @enderror" value="{{ old('programdonasi_id') }}">
                                <option value="">--Pilih Jenis Program--</option>
                                @foreach ($programDonasi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_program }}</option>
                                @endforeach
                            </select>
                        @error('programdonasi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <label for="">Keterangan <small style="color: red">*opsional</small></label>
                        <textarea class="form-control" id="editor" name="keterangan" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Lanjutkan pembayaran</button>
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
