@extends('layout')
@section('title', 'Tambah Buku')
@section('content')
    <div class="container">
        @if(Session::has('pesan'))
            <div class="alert alert-success">
                {{ Session::get('pesan') }}
            </div>
        @endif

        @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        
        <h4>Tambah Buku</h4>
        <form method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul">
            </div>
            <div>
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis">
            </div>
            <div>
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-2">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit">
            </div>

            <div class="col-span-full mt-6">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <div class="mt-2">
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                </div>
            </div>

            <div class="col-span-full mt-5">
                <label for="gallery" class="form-label">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper">
                    <input type="file" name="gallery[]" id="gallery" class="form-control mb-2">
                </div>
                <button type="button" class="btn btn-primary" onclick="addFileInput()">Tambah Input Data</button>
            </div>

            <button class="btn btn-primary mt-4" type="submit">Simpan</button>
        </form>
    </div>

    <script type="text/javascript">
        function addFileInput() {
            var div = document.getElementById('fileinput_wrapper');
            div.innerHTML += '<input type="file" name="gallery[]" class="form-control mb-2">';
        };
    </script>
@endsection
