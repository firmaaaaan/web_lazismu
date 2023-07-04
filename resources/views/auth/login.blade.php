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
		<title>Masuk - Lazismu BS</title>
		<!-- CSS files -->
		<link href="{{ asset('dist') }}/css/tabler.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/tabler-flags.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/tabler-payments.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/tabler-vendors.min.css?1668287865" rel="stylesheet"/>
		<link href="{{ asset('dist') }}/css/demo.min.css?1668287865" rel="stylesheet"/>
        <link rel="shortcut icon" href="{{ asset('dist/img/lazismu.png') }}" type="image/x-icon">
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
			<div class="card card-md">
				<div class="card-body">
                    @if ($message = Session::get('Info'))
                        <div class="alert alert-primary alert-block mb-2">
                            <p><i class="bi bi-lightbulb-fill"></i><strong>Berhasi! </strong>{{ $message }}</p>
                        </div>
                    @endif
					<h2 class="h2 text-center mb-4">Login dengan akun Anda</h2>
					<form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="my-2">
                            <label class="form-label">
                                Password
                                <span class="form-label-description">
                                {{-- <a href="{{ route('password.request') }}">Lupa password</a> --}}
                                </span>
                            </label>
                                <x-text-input id="password" class="block mt-1 w-full form-control"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Masuk</button>
                        </div>
					</form>
				</div>
			</div>
			<div class="text-center text-muted mt-3">
				{{-- Tidak mempunyai akun? <a href="{{ route('donatur.register') }}" tabindex="-1">Daftar</a> --}}
			</div>
			</div>
		</div>
		<!-- Libs JS -->
		<!-- Tabler Core -->
		<script src="{{ asset('dist') }}/js/tabler.min.js?1668287865" defer></script>
		<script src="{{ asset('dist') }}/js/demo.min.js?1668287865" defer></script>
	</body>
</html>
