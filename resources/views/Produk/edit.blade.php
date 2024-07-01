@extends('layout.template');
<!-- START FORM -->
@section('content')
    <form action='{{ url('produk/' . $data->id) }}' method='post' enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ url('produk') }}" class="btn btn-secondary">Kembali</a>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' id="nama" value="{{ $data->nama }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga" class="col-sm-2 col-form-label">Harga (Rp)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name='harga' id="harga" value="{{ $data->harga }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='deskripsi' id="deskripsi"
                        value="{{ $data->deskripsi }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name='foto' id="foto"
                        value="{{ Session::get('deksripsi') }}">
                </div>
            </div>
            @if ($data->img_path)
                <label class="col-sm-2 col-form-label"></label>
                <div class="mb-3 d-inline">
                    <img src="{{ url('img/' . $data->img_path) }}" alt=""
                        style="max-width: 200px; max-height: 200px;">
                </div>
            @endif
            <div class="mb-3 row">
                <label for="submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
    </form>
    </div>
@endsection
