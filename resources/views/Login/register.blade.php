@extends('layout/template')

@section('content')
    <div class="center border rounded px-3 py-3 mx-auto" style="margin-top: 100px; width: 400px;">
        <div style="text-align: center">
            <h1>Registrasi</h1>
        </div>
        <form action="{{ url('sesi/registation') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan nama"
                    value="{{ Session::get('nama') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Masukan Email"
                    value="{{ Session::get('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password">
            </div>
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="text-center">
                <p>Sudah punya akun? <a href="{{ url('sesi') }}">Login</a></p>
            </div>
        </form>
    </div>
@endsection
