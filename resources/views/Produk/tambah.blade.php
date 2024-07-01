@extends('layout.template');
<!-- START FORM -->
@section('content')
    <form action='{{ url('produk') }}' method='post' enctype="multipart/form-data">
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ url('produk') }}" class="btn btn-secondary">Kembali</a>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' id="nama"
                        value="{{ Session::get('nama') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga" class="col-sm-2 col-form-label">Harga (Rp)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name='harga' id="harga"
                        value="{{ Session::get('harga') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='deskripsi' id="deskripsi"
                        value="{{ Session::get('deskripsi') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name='foto' id="foto"
                        value="{{ Session::get('deksripsi') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
    </form>
    </div>
@endsection
