@extends('layouts.master')
@section('title', 'Data User')
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
            Data user
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
            <div class="table-responsive">
                @role('administrator')
                    <a href="{{ route('user.create') }}" class="btn btn-primary my-2 mr-2 btn-sm" style="float: right"><i class="bi bi-plus-square"></i>Tambah user</a>
                @endrole
                <table class="table" id="tdatatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>No. Handphone</th>
                            <th>Email</th>
                            <th>Role</th>
                            @role('administrator')
                                <th>Opsi</th>
                            @endrole
                        </tr>
                    </thead>
                    @php
                        $no=1
                    @endphp
                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @foreach($item->roles as $role)
                                    {{ $role->name }}<br>
                                @endforeach
                            </td>
                            @role('administrator')
                                <td>
                                    <a href="{{ route('user.destroy', $item->id) }}" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                                </td>
                            @endrole
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
