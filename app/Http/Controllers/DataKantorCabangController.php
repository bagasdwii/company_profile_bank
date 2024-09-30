<?php

namespace App\Http\Controllers;

use App\Models\DataKantorCabang;
use Illuminate\Http\Request;

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
            $lokasiFile = 'assets/data_kantor_cabang/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
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
        //
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
            $lokasiFile = 'assets/data_kantor_cabang/';
            $gambarLamaPath = public_path($lokasiFile . $dataKantorCabang->gambar);
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        } else{
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
        // Lokasi file gambar
        $gambarPath = public_path('assets/data_kantor_cabang/' . $dataKantorCabang->gambar);

        // Cek apakah file gambar tersebut ada di folder
        if (file_exists($gambarPath)) {
            // Jika ada, hapus file gambar
            unlink($gambarPath);
        }

        // Hapus data dari database
        $dataKantorCabang->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_kantor_cabang')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }
}
