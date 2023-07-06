
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta16
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
		<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
		<title>Daftar - Lazismu BS</title>
		<!-- CSS files -->
		<link href="{{ asset('dist') }}/css/tabler.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/tabler-flags.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/tabler-payments.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/tabler-vendors.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/demo.min.css?1668287865" rel="stylesheet"/>
		<style>
			@import url('https://rsms.me/inter/inter.css');
			:root {
				--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
			}
		</style>
	</head>
	<body  class=" border-top-wide border-primary d-flex flex-column">
		<script src="{{ asset('dist') }}/js/demo-theme.min.js?1668287865"></script>
		<div class="page page-center">
			<div class="container container-tight py-4">
			<div class="text-center mb-4">
				<a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('dist/img/lazismuu.png') }}" width="150" alt=""></a>
			</div>
			<form class="card card-md" method="POST" action="{{ route('donatur.store') }}">
                @csrf
				<div class="card-body">
					<h2 class="card-title text-center mb-4">Create new account</h2>
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
					<div>
                        <label class="form-label">No Handphone</label>
                        <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="phone_number" :value="old('phone_number')" required autofocus />
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
					<div class="form-footer">
					<button type="submit" class="btn btn-primary w-100">Buat akun baru</button>
					</div>
				</div>
			</form>
			<div class="text-center text-muted mt-3">
				Sudah punya akun? <a href="{{ route('login') }}" tabindex="-1">Masuk</a>
			</div>
			</div>
		</div>
		<!-- Libs JS -->
		<!-- Tabler Core -->
		<script src="{{ asset('dist') }}/js/tabler.min.js?1668287865" defer></script>
		<script src="{{ asset('dist') }}/js/demo.min.js?1668287865" defer></script>
	</body>
</html>
