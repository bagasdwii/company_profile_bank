<?php

namespace App\Http\Controllers;

use App\Models\DataProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index(Request $request)
    {
        // Mendapatkan kata kunci pencarian dari request
        $search = $request->input('search');

        // Query untuk mengambil data produk berdasarkan pencarian dan pagination
        $produks = DataProduk::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%");
        })->orderBy('updated_at', 'desc')->paginate(10);

        // Mengirimkan data produk dan kata kunci pencarian ke view
        return view('produks.index', compact('produks', 'search'));
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
            // Simpan gambar ke storage/app/public/data_produk
            $gambarPath = $gambar->store('data_produk', 'public');
            $input['gambar'] = $gambarPath;
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
        return view('produks.show', compact('dataProduk'));
        
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
            // Hapus gambar lama jika ada
            if ($dataProduk->gambar) {
                Storage::disk('public')->delete($dataProduk->gambar);
            }

            // Simpan gambar baru ke storage/app/public/data_produk
            $gambarPath = $gambar->store('data_produk', 'public');
            $input['gambar'] = $gambarPath;
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
        // Hapus file gambar dari disk storage jika ada
        if ($dataProduk->gambar) {
            Storage::disk('public')->delete($dataProduk->gambar);
        }

        // Hapus data dari database
        $dataProduk->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_produk')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }

}
