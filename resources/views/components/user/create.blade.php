@extends('layouts.master')
@section('title', 'Buat User')
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
            Form tambah user
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block mb-2">
                        <p><i class="bi bi-check-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="card-body">
                        <div>
                            <label class="form-label">Nama</label>
                            <x-text-input id="name" class="block mt-1 mb-2 w-full form-control" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label class="form-label">No Handphone</label>
                            <x-text-input id="name" class="block mt- w-full form-control" type="number" name="phone_number" :value="old('phone_number')" required autofocus />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                        <div class="mb-3 my-2">
                            <label class="form-label">Email</label>
                            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                        <label class="form-label">Password</label>
                            <x-text-input id="password" class="block mt-1 w-full form-control"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                                <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                                    type="password"
                                    name="password_confirmation" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Registrasi Sebagai</label>
                            <select name="role_id" id class="form-control">
                                <option value="">--Pilih Hak Akses--</option>
                                <option value="administrator">Administrator</option>
                                <option value="pimpinan">Pimpinan</option>
                                <option value="petugas">Petugas</option>
                                <option value="driver">Driver</option>
                                <option value="donatur">Donatur</option>
                            </select>
                            <x-input-error :messages="$errors->get('role_id')" class="mt-2 alert-danger" />
                        </div>
                        <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Buat user baru</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
