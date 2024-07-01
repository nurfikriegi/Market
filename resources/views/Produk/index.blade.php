@extends('layout.template');

@section('content')
    <div style="text-align: right">
        <a href="{{ url('sesi/logout') }}" class="btn btn-danger">Logout</a>
    </div>
    <div style="margin-top: 10px;">
        <form class="d-flex" action="{{ url('produk') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                placeholder="Masukkan Nama/Harga/Deksripsi" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href='{{ url('produk/create') }}' class="btn btn-primary">+ Tambah Data</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-3">Nama Produk</th>
                    <th class="col-md-1">Harga</th>
                    <th class="col-md-3">Deskripsi</th>
                    <th class="col-md-2">Tampilan</th>
                    <th class="col-md-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>Rp.{{ $item->harga }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            @if ($item->img_path)
                                <img src="{{ url('img/' . $item->img_path) }}" alt=""
                                    style="max-width: 50px; max-height: 50px;">
                            @else
                                <img src="{{ url('img/default.png') }}" alt=""
                                    style="max-width: 50px; max-height: 50px;">
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('produk/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                            <form class="d-inline" action="{{ url('produk/' . $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->withQueryString()->links() }}
    </div>
@endsection
