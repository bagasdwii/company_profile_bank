<?php

namespace App\Http\Controllers;

use App\Models\DataTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataTabunganController extends Controller
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
       $tabungans = DataTabungan::when($search, function ($query, $search) {
           return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('keterangan', 'like', "%{$search}%");
        })->orderBy('updated_at', 'desc')->paginate(10);

       // Mengirimkan data produk dan kata kunci pencarian ke view
        return view('tabungans.index', compact('tabungans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tabungans.create');
        
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
            // Simpan gambar ke storage/app/public/data_tabungan
            $gambarPath = $gambar->store('data_tabungan', 'public');
            $input['gambar'] = $gambarPath;
        }
    
        DataTabungan::create($input);
    
        return redirect('/data_tabungan')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataTabungan  $dataTabungan
     * @return \Illuminate\Http\Response
     */
    public function show(DataTabungan $dataTabungan)
    {
        return view('tabungans.show', compact('dataTabungan'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataTabungan  $dataTabungan
     * @return \Illuminate\Http\Response
     */
    public function edit(DataTabungan $dataTabungan)
    {
        return view('tabungans.edit', compact('dataTabungan'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataTabungan  $dataTabungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataTabungan $dataTabungan)
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
            if ($dataTabungan->gambar) {
                Storage::disk('public')->delete($dataTabungan->gambar);
            }

            // Simpan gambar baru ke storage/app/public/data_tabungan
            $gambarPath = $gambar->store('data_tabungan', 'public');
            $input['gambar'] = $gambarPath;
        } else {
            unset($input['gambar']);
        }
    
        $dataTabungan->update($input);
    
        return redirect('/data_tabungan')->with('message', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataTabungan  $dataTabungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataTabungan $dataTabungan)
    {
       // Hapus file gambar dari disk storage jika ada
        if ($dataTabungan->gambar) {
            Storage::disk('public')->delete($dataTabungan->gambar);
        }

        // Hapus data dari database
        $dataTabungan->delete();

        return redirect('/data_tabungan')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }

}
