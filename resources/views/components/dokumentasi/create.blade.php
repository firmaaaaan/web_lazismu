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
                        <div class="form-group">
                            <label for="user_id">Judul</label>
                            <input type="text" value="" name="judul" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Foto Unggulan</label>
                            <input type="file" name="foto_unggulan" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Text</label>
                            <textarea type="text" value="" name="text" id="editor" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Buat</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection
