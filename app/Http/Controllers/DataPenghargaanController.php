<?php

namespace App\Http\Controllers;

use App\Models\DataPenghargaan;
use Illuminate\Http\Request;

class DataPenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penghargaans = DataPenghargaan::orderBy('updated_at', 'desc')->get();

        return view('penghargaans.index', compact('penghargaans'));
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
            $lokasiFile = 'assets/data_penghargaan/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
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
            $lokasiFile = 'assets/data_penghargaan/';
            // Hapus gambar lama jika ada
            $gambarLamaPath = public_path($lokasiFile . $dataPenghargaan->gambar);
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
       // Lokasi file gambar
       $gambarPath = public_path('assets/data_penghargaan/' . $dataPenghargaan->gambar);

       // Cek apakah file gambar tersebut ada di folder
       if (file_exists($gambarPath)) {
           // Jika ada, hapus file gambar
           unlink($gambarPath);
       }

       // Hapus data dari database
       $dataPenghargaan->delete();

       // Redirect dengan pesan sukses
       return redirect('/data_penghargaan')->with('message', 'Data berhasil dihapus beserta gambarnya');
   }
}
