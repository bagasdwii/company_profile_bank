<?php

namespace App\Http\Controllers;

use App\Models\DataSlider;
use Illuminate\Http\Request;

class DataSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data slider yang diurutkan berdasarkan updated_at secara descending (terbaru dulu)
        $sliders = DataSlider::orderBy('updated_at', 'desc')->get();

        return view('sliders.index', compact('sliders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sliders.create');
        
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
            $lokasiFile = 'assets/data_slider/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        }
    
        DataSlider::create($input);
    
        return redirect('/data_slider')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataSlider  $dataSlider
     * @return \Illuminate\Http\Response
     */
    public function show(DataSlider $dataSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataSlider  $dataSlider
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSlider $dataSlider)
    {
        // dd($dataSlider);
        return view('sliders.edit', compact('dataSlider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataSlider  $dataSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataSlider $dataSlider)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image'
        ]);
    
        $input = $request->all();
        if ($gambar = $request->file('gambar')) {
            $lokasiFile = 'assets/data_slider/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        } else{
            unset($input['gambar']);
        }
    
        $dataSlider->update($input);
    
        return redirect('/data_slider')->with('message', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataSlider  $dataSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSlider $dataSlider)
    {
        // Lokasi file gambar
        $gambarPath = public_path('assets/data_slider/' . $dataSlider->gambar);

        // Cek apakah file gambar tersebut ada di folder
        if (file_exists($gambarPath)) {
            // Jika ada, hapus file gambar
            unlink($gambarPath);
        }

        // Hapus data dari database
        $dataSlider->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_slider')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }

}
