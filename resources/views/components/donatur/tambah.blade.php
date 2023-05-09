@extends('layouts.master')
@section('title', 'Tambah Donatur')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
            <form class="card card-md" method="POST" action="{{ route('donatur.store') }}">
                @csrf
                    <div class="my-2 mx-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input id="name" class="block mt-1 w-full form-control" type="text" name="nama_donatur" :value="old('nama_donatur')" required autofocus />
                        <x-input-error :messages="$errors->get('name_donatur')" class="mt-2" />
                    </div>
					<div class="mb-3 mx-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input id="tempat_lahir" class="block mt-1 w-full form-control" type="text" name="tempat_lahir" :value="old('tempat_lahir')" required />
                        <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
					</div>
                    <div class="my-2 mx-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input id="tanggal_lahir" class="block mt-1 w-full form-control" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required autofocus />
                        <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                    </div>
					<div class="mb-3 mx-3">
                        <label class="form-label">Email</label>
                        <input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
					</div>
                    <div class="my-2 mx-3">
                        <label class="form-label">No Handphone</label>
                        <input id="no_hp" class="block mt-1 w-full form-control" type="number" name="no_hp" :value="old('no_hp')" required autofocus />
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                    </div>
					<div class="mb-3 mx-3">
                        <label class="form-label">Alamat</label>
                        <textarea id="email" class="block mt-1 w-full form-control" type="text" name="alamat" :value="old('alamat')" required ></textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
					</div>
                    <div class="mb-3 mx-3">
                    <label class="form-label">Password</label>
						<x-text-input id="password" class="block mt-1 w-full form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
					</div>
                    <div class="mb-3 mx-3">
                        <label class="form-label">Konfirmasi Password</label>
                            <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                                type="password"
                                name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
					<div class="mb-3">
					<button type="submit" class="btn btn-primary w-100">Simpan</button>
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
