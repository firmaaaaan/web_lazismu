@extends('layouts.master')
@section('title', 'Tambah Donatur')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block mb-2">
                                <p><i class="bi bi-check-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('donatur.store') }}">
                        @csrf
                        <div class="my-2 mx-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input id="name" class="block mt-1 w-full form-control" type="text" name="nama_donatur" :value="old('nama_donatur')" required autofocus />
                            <x-input-error :messages="$errors->get('name_donatur')" class="mt-2" />
                        </div>
                        <div class="mb-3 mx-3">
                            <label class="form-label">Email</label>
                            <input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                            <button type="submit" class="btn btn-primary btn-sm my-3 mx-3">Tambah</button>
                        </div>
                    </form>
                    </div>
                </div>
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
