<?php

namespace App\Http\Controllers;

use App\Models\DataDeposito;
use Illuminate\Http\Request;

class DataDepositoController extends Controller
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
       $depositos = DataDeposito::when($search, function ($query, $search) {
           return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('keterangan', 'like', "%{$search}%");
        })->orderBy('updated_at', 'desc')->paginate(10);

       // Mengirimkan data produk dan kata kunci pencarian ke view
        return view('depositos.index', compact('depositos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('depositos.create');
        
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
            $lokasiFile = 'assets/data_deposito/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        }
    
        DataDeposito::create($input);
    
        return redirect('/data_deposito')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataDeposito  $dataDeposito
     * @return \Illuminate\Http\Response
     */
    public function show(DataDeposito $dataDeposito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataDeposito  $dataDeposito
     * @return \Illuminate\Http\Response
     */
    public function edit(DataDeposito $dataDeposito)
    {
        return view('depositos.edit', compact('dataDeposito'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataDeposito  $dataDeposito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataDeposito $dataDeposito)
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
            $lokasiFile = 'assets/data_deposito/';
            $gambarLamaPath = public_path($lokasiFile . $dataDeposito->gambar);
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
    
        $dataDeposito->update($input);
    
        return redirect('/data_deposito')->with('message', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataDeposito  $dataDeposito
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataDeposito $dataDeposito)
    {
        // Lokasi file gambar
        $gambarPath = public_path('assets/data_deposito/' . $dataDeposito->gambar);

        // Cek apakah file gambar tersebut ada di folder
        if (file_exists($gambarPath)) {
            // Jika ada, hapus file gambar
            unlink($gambarPath);
        }

        // Hapus data dari database
        $dataDeposito->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_deposito')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }
}
