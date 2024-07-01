<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = produk::where('nama', 'like', "%$katakunci%")
                ->orWhere('harga', 'like', "%$katakunci%")
                ->orWhere('deskripsi', 'like', "%$katakunci%")
                ->orderBy('nama', 'asc')
                ->paginate($jumlahbaris);
        } else {
            $data = produk::orderBy('nama', 'asc')->paginate($jumlahbaris);
        }

        return view("Produk/index")->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Produk/tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('harga', $request->harga);
        Session::flash('deskripsi', $request->deskripsi);

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'harga.numeric' => 'Harga hanya boleh diisi angka',
            'harga.required' => 'Harga tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'foto.required' => 'Silahkan lampirkan foto',
            'foto.mimes' => 'Ekstensi foto hanya boleh (JPG, JPEG, PNG)'
        ]);
        $file = $request->file('foto');
        $ekstensi_file = $file->extension();
        $nama_foto = date('ymdhis') . "." . $ekstensi_file;

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'img_path' => $nama_foto
        ];

        produk::create($data);
        $message = 'Produk (' . $request->nama . ') berhasil disimpan';
        $file->move(public_path('img'), $nama_foto);
        return redirect()->to('produk')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = produk::where('id', $id)->first();
        return view('produk.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'harga.numeric' => 'Harga hanya boleh diisi angka',
            'harga.required' => 'Harga tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong'
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ];

        if ($request->hasfile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpg,png,jpeg'
            ], [
                'foto.mimes' => 'Ekstensi foto hanya boleh (JPG, JPEG, PNG)'
            ]);

            //pindahkan file baru
            $file = $request->file('foto');
            $ekstensi_file = $file->extension();
            $nama_foto = date('ymdhis') . "." . $ekstensi_file;
            $file->move(public_path('img'), $nama_foto);

            //hapus file lama
            $produk = produk::where('id', $id)->first();
            File::delete(public_path('img/') . "/" . $produk->img_path);

            $data['img_path'] = $nama_foto;
        }

        produk::where('id', $id)->update($data);
        $message = 'Produk (' . $request->nama . ') berhasil di-update';
        return redirect()->to('produk')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = produk::where('id', $id)->first();
        $nama = $data->nama;

        //delete file
        File::delete(public_path('img/') . "/" . $data->img_path);

        produk::where('id', $id)->delete();
        $message = 'Produk (' . $nama . ') berhasil dihapus';
        return redirect()->to('produk')->with('success', $message);
    }
}
