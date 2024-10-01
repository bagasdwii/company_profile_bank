<?php

namespace App\Http\Controllers;

use App\Models\DataPpob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPpobController extends Controller
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
       $ppobs = DataPpob::when($search, function ($query, $search) {
           return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('keterangan', 'like', "%{$search}%");
        })->orderBy('updated_at', 'desc')->paginate(10);

       // Mengirimkan data produk dan kata kunci pencarian ke view
        return view('ppobs.index', compact('ppobs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ppobs.create');
        
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
            'gambar' => 'required|image',
            'nama_button' => 'required',
            'nomor_button' => 'required'
        ]);
    
        $input = $request->all();
        if ($gambar = $request->file('gambar')) {
            // Simpan gambar ke storage/app/public/data_ppob
            $gambarPath = $gambar->store('data_ppob', 'public');
            $input['gambar'] = $gambarPath;
        }
    
        DataPpob::create($input);
    
        return redirect('/data_ppob')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPpob  $dataPpob
     * @return \Illuminate\Http\Response
     */
    public function show(DataPpob $dataPpob)
    {
        return view('ppobs.show', compact('dataPpob'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPpob  $dataPpob
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPpob $dataPpob)
    {
        return view('ppobs.edit', compact('dataPpob'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPpob  $dataPpob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPpob $dataPpob)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image',
            'nama_button' => 'required',
            'nomor_button' => 'required'

        ]);
    
        $input = $request->all();
        if ($gambar = $request->file('gambar')) {
            // Hapus gambar lama jika ada
            if ($dataPpob->gambar) {
                Storage::disk('public')->delete($dataPpob->gambar);
            }

            // Simpan gambar baru ke storage/app/public/data_ppob
            $gambarPath = $gambar->store('data_ppob', 'public');
            $input['gambar'] = $gambarPath;
        } else {
            unset($input['gambar']);
        }
    
        $dataPpob->update($input);
    
        return redirect('/data_ppob')->with('message', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPpob  $dataPpob
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPpob $dataPpob)
    {
        // Hapus file gambar dari disk storage jika ada
        if ($dataPpob->gambar) {
            Storage::disk('public')->delete($dataPpob->gambar);
        }


        // Hapus data dari database
        $dataPpob->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_ppob')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }

}
