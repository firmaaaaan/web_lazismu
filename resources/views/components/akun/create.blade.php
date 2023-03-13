@extends('layouts.master')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="bg-light rounded d-flex align items center p-3">
                            <label for="">Kode</label>
                            <input type="text" class="form-control" name="kode">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Nama Akun</label>
                            <input type="text" class="form-control" name="nama_akun">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Persen hak amil</label>
                            <input type="text" name="persen_hak_amil" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3 btn-sm">Tambah akun</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
