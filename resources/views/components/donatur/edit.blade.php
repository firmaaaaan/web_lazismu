@extends('layouts.master')
@section('title', 'Edit Donatur')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
            <form class="card card-md" method="POST" action="{{ route('donatur.update', $donatur->id) }}">
                @csrf
                    <div class="my-2 mx-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input id="name" class="block mt-1 w-full form-control" value="{{ $donatur->nama_donatur }}" type="text" name="nama_donatur" :value="old('nama_donatur')" required autofocus />

                    </div>
					<div class="mb-3 mx-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input id="tempat_lahir" class="block mt-1 w-full form-control" value="{{ $donatur->tempat_lahir }}" type="text" name="tempat_lahir" :value="old('tempat_lahir')" required />

					</div>
                    <div class="my-2 mx-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input id="tanggal_lahir" class="block mt-1 w-full form-control" value="{{ $donatur->tanggal_lahir }}" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required autofocus />

                    </div>
					<div class="mb-3 mx-3">
                        <label class="form-label">Email</label>
                        <input id="email" class="block mt-1 w-full form-control" type="email" value="{{ $donatur->email }}" name="email" :value="old('email')" required />

					</div>
                    <div class="my-2 mx-3">
                        <label class="form-label">No Handphone</label>
                        <input id="no_hp" class="block mt-1 w-full form-control" inputmode="numeric" pattern="[0-9]*" value="{{ $donatur->no_hp }}" type="number" name="no_hp" :value="old('no_hp')" required autofocus />

                    </div>
					<div class="mb-3 mx-3">
                        <label class="form-label">Alamat</label>
                        <textarea id="email" class="block mt-1 w-full form-control" type="text" name="alamat" :value="old('alamat')" required >{{ $donatur->alamat }}</textarea>

					</div>
					<div class="mb-3">
					<div class="form-footer">
					<button type="submit" class="btn btn-success btn-sm mr-3" style="float: right">Simpan</button>
					</div>
			</form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ))
        .catch( error => {
            console.log( error );
        } );
</script>

@endsection
