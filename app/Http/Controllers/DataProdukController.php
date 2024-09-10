<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use Illuminate\Http\Request;

class DataProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data slider yang diurutkan berdasarkan updated_at secara descending (terbaru dulu)
        $produks = DataProduk::orderBy('updated_at', 'desc')->get();

        return view('produks.index', compact('produks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produks.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required|image'
        ]);
    
        $input = $request->all();
        if ($gambar = $request->file('gambar')) {
            $lokasiFile = 'assets/data_produk/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        }
    
        DataProduk::create($input);
    
        return redirect('/data_produk')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function show(DataProduk $dataProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(DataProduk $dataProduk)
    {
        // dd($dataProduk);
        return view('produks.edit', compact('dataProduk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataProduk $dataProduk)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image'
        ]);

        $input = $request->all();
        if ($gambar = $request->file('gambar')) {
            $lokasiFile = 'assets/data_produk/';
            // Hapus gambar lama jika ada
            $gambarLamaPath = public_path($lokasiFile . $dataProduk->gambar);
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }

            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        } else {
            unset($input['gambar']);
        }

        $dataProduk->update($input);

        return redirect('/data_produk')->with('message', 'Data berhasil diedit dan gambar lama dihapus');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataProduk $dataProduk)
    {
        // Lokasi file gambar
        $gambarPath = public_path('assets/data_produk/' . $dataProduk->gambar);

        // Cek apakah file gambar tersebut ada di folder
        if (file_exists($gambarPath)) {
            // Jika ada, hapus file gambar
            unlink($gambarPath);
        }

        // Hapus data dari database
        $dataProduk->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_produk')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }

}
