@extends('layouts.master')
@section('title','Profile')
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
            Profile
            </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body rounded" >
    <div class="container-xl">
        <div class="card mb-2">
            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
        <div class="card">
            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Delete Account') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </p>
                        </header>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-team">
                            Delete Account
                        </a>
                            <div class="modal modal-blur fade" id="modal-team" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Delete Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="post" action="{{ route('profile.destroy') }}">
                                        @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900">Are you sure your want to delete your account?</h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>

                                    <div class="mt-6">
                                        <x-input-label for="password" value="Password" class="sr-only" />

                                        <x-text-input
                                            id="password"
                                            name="password"
                                            type="password"
                                            class="mt-1 block w-3/4 form-control"
                                            placeholder="Password"
                                        />

                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                        <div class="modal-footer">
                                            <button type="sumbit" class="btn btn-danger">Delete</button>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
