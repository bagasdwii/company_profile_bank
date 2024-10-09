<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataKontakController extends Controller
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
            $kontaks = DataKontak::when($search, function ($query, $search) {
                return $query->where('email', 'like', "%{$search}%");
            })->orderBy('updated_at', 'desc')->paginate(10);
    
            // Mengirimkan data produk dan kata kunci pencarian ke view
            return view('kontaks.index', compact('kontaks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kontaks.create');

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
            'email' => 'required',
            'telepon' => 'required',
            'no_wa' => 'required',
            'alamat' => 'required',
            'gmap' => 'required',

        ]);

        $input = $request->all();
    

        DataKontak::create($input);

        return redirect('/data_kontak')->with('message', 'Data kontak berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKontak  $dataKontak
     * @return \Illuminate\Http\Response
     */
    public function show(DataKontak $dataKontak)
    {
        return view('kontaks.show', compact('dataKontak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataKontak  $dataKontak
     * @return \Illuminate\Http\Response
     */
    public function edit(DataKontak $dataKontak)
    {
        return view('kontaks.edit', compact('dataKontak'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataKontak  $dataKontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataKontak $dataKontak)
    {
        $request->validate([
            'email' => 'required',
            'telepon' => 'required',
            'no_wa' => 'required',
            'alamat' => 'required',
            'gmap' => 'required',
        ]);

        $input = $request->all();
    
        $dataKontak->update($input);

        return redirect('/data_kontak')->with('message', 'Data kontak berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKontak  $dataKontak
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataKontak $dataKontak)
    {
        
        $dataKontak->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_kontak')->with('message', 'Data berhasil dihapus');
    }
}
