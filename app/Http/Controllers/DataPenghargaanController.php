<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPenghargaan;
use Illuminate\Support\Facades\Storage;

class DataPenghargaanController extends Controller
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
       $penghargaans = DataPenghargaan::when($search, function ($query, $search) {
           return $query->where('judul', 'like', "%{$search}%");
       })->orderBy('updated_at', 'desc')->paginate(10);

       // Mengirimkan data produk dan kata kunci pencarian ke view
       return view('penghargaans.index', compact('penghargaans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penghargaans.create');
        
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
            'gambar' => 'required|image'
        ]);
    
        $input = $request->all();
        if ($gambar = $request->file('gambar')) {
            // Simpan gambar ke storage/app/public/data_penghargaan
            $gambarPath = $gambar->store('data_penghargaan', 'public');
            $input['gambar'] = $gambarPath;
        }
    
        DataPenghargaan::create($input);
    
        return redirect('/data_penghargaan')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPenghargaan  $dataPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function show(DataPenghargaan $dataPenghargaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPenghargaan  $dataPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPenghargaan $dataPenghargaan)
    {
        return view('penghargaans.edit', compact('dataPenghargaan'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPenghargaan  $dataPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPenghargaan $dataPenghargaan)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'image'
        ]);

        $input = $request->all();
        if ($gambar = $request->file('gambar')) {
            // Hapus gambar lama jika ada
            if ($dataPenghargaan->gambar) {
                Storage::disk('public')->delete($dataPenghargaan->gambar);
            }

            // Simpan gambar baru ke storage/app/public/data_penghargaan
            $gambarPath = $gambar->store('data_penghargaan', 'public');
            $input['gambar'] = $gambarPath;
        } else {
            unset($input['gambar']);
        }

        $dataPenghargaan->update($input);

        return redirect('/data_penghargaan')->with('message', 'Data berhasil diedit dan gambar lama dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPenghargaan  $dataPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPenghargaan $dataPenghargaan)
    {
       // Hapus file gambar dari disk storage jika ada
       if ($dataPenghargaan->gambar) {
        Storage::disk('public')->delete($dataPenghargaan->gambar);
    }
       // Hapus data dari database
       $dataPenghargaan->delete();

       // Redirect dengan pesan sukses
       return redirect('/data_penghargaan')->with('message', 'Data berhasil dihapus beserta gambarnya');
   }
}
