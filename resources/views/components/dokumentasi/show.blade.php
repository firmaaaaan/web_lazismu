@extends('layouts.master')
@section('title', 'Detile Dokumentasi')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <!-- Post content-->
                        <article>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded mx-auto d-block" src="/images/{{ $doks->foto_unggulan }}" width="500"  alt="{{ $doks->judul }}" /></figure>
                            <!-- Post header-->
                            <header class="mb-4 text-center">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1">{{ $doks->judul }}</h1>
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2">Publish on {{ $doks->created_at->diffForHumans() }}</div>

                            </header>
                            <!-- Post content-->
                            <section class="mb-5 text-left w-100">
                                <p class="fs-5 mb-4">{!! $doks->text !!}</p>
                            </section>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
