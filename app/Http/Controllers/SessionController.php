<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index()
    {
        return view('login/index');
    }

    public function loginAction(Request $request)
    {
        Session::flash('email', $request->email);

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infoLogin)) {
            return redirect('produk')->with('success', 'Selamat datang');
        } else {
            return  redirect('sesi')->withErrors('Email atau password tidak valid');
        }
    }

    public function logoutAction()
    {
        Auth::logout();
        return redirect('sesi');
    }

    public function registerForm()
    {
        return view('Login/register');
    }

    public function registData(Request $request)
    {
        Session::flash('email', $request->email);
        Session::flash('nama', $request->nama);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::create($data);

        return redirect('sesi')->with('success', 'Data berhasil diregistrasi');
    }
}
