<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKantorCabang;
use Illuminate\Support\Facades\Storage;

class DataKantorCabangController extends Controller
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
       $kantorCabangs = DataKantorCabang::when($search, function ($query, $search) {
           return $query->where('nama', 'like', "%{$search}%");
        })->orderBy('updated_at', 'desc')->paginate(10);

       // Mengirimkan data produk dan kata kunci pencarian ke view
        return view('kantorCabangs.index', compact('kantorCabangs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kantorCabangs.create');
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
            'nama' => 'required',
            'alamat' => 'required',
            'gmap' => 'required',
            'telepon' => 'required',
            'gambar' => 'required|image'
        ]);

        $input = $request->all();
        
        if ($gambar = $request->file('gambar')) {
            // Simpan gambar ke storage/app/public/data_kantor_cabang
            $gambarPath = $gambar->store('data_kantor_cabang', 'public');
            $input['gambar'] = $gambarPath;
        }

        DataKantorCabang::create($input);

        return redirect('/data_kantor_cabang')->with('message', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKantorCabang  $dataKantorCabang
     * @return \Illuminate\Http\Response
     */
    public function show(DataKantorCabang $dataKantorCabang)
    {
        return view('kantorCabangs.show', compact('dataKantorCabang'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataKantorCabang  $dataKantorCabang
     * @return \Illuminate\Http\Response
     */
    public function edit(DataKantorCabang $dataKantorCabang)
    {
        return view('kantorCabangs.edit', compact('dataKantorCabang'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataKantorCabang  $dataKantorCabang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataKantorCabang $dataKantorCabang)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'gmap' => 'required',
            'telepon' => 'required',
            'gambar' => 'image'
        ]);

        $input = $request->all();
        
        if ($gambar = $request->file('gambar')) {
            // Hapus gambar lama jika ada
            if ($dataKantorCabang->gambar) {
                Storage::disk('public')->delete($dataKantorCabang->gambar);
            }

            // Simpan gambar baru ke storage/app/public/data_kantor_cabang
            $gambarPath = $gambar->store('data_kantor_cabang', 'public');
            $input['gambar'] = $gambarPath;
        } else {
            unset($input['gambar']);
        }

        $dataKantorCabang->update($input);

        return redirect('/data_kantor_cabang')->with('message', 'Data berhasil diedit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKantorCabang  $dataKantorCabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataKantorCabang $dataKantorCabang)
    {
        // Hapus file gambar dari disk storage jika ada
        if ($dataKantorCabang->gambar) {
            Storage::disk('public')->delete($dataKantorCabang->gambar);
        }

        // Hapus data dari database
        $dataKantorCabang->delete();

        return redirect('/data_kantor_cabang')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }

}
