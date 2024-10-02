<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKantorKas;
use App\Models\DataKantorCabang;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class DataKantorKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $idkantorcabang)
{
    // Mendapatkan kata kunci pencarian dari request
    $search = $request->input('search');

    // Query untuk mengambil data kantor kas berdasarkan pencarian dan pagination
    $kantorKass = DataKantorKas::where('kantor_cabang_id', $idkantorcabang)
        ->when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })
        ->orderBy('updated_at', 'desc')
        ->paginate(10);

    // Mengirimkan data kantor kas, kata kunci pencarian, dan id kantor cabang ke view
    return view('kantorKas.index', compact('kantorKass', 'idkantorcabang', 'search'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idkantorcabang)
    {
        // Dapatkan data cabang berdasarkan ID
        $kantorCabang = DataKantorCabang::findOrFail($idkantorcabang);

        // Kirim data cabang ke form create kantor kas
        return view('kantorKas.create', compact('kantorCabang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idkantorcabang)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'gmap' => 'required',
            'telepon' => 'required',
            'gambar' => 'required|image'
        ]);

        // Simpan data kantor kas dengan mengaitkan ke kantor kas
        $input = $request->all();
        
        if ($gambar = $request->file('gambar')) {
            // Simpan gambar ke storage/app/public/data_kantor_kas
            $gambarPath = $gambar->store('data_kantor_kas', 'public');
            $input['gambar'] = $gambarPath;
        }
        $input['kantor_cabang_id'] = $idkantorcabang;
        DataKantorKas::create($input);

        return redirect()->route('data_kantor_kas.index', $idkantorcabang)
        ->with('message', 'Data kantor kas berhasil ditambahkan');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKantorKas  $dataKantorKas
     * @return \Illuminate\Http\Response
     */
    // public function show($idkantorcabang, DataKantorKas $dataKantorKas)
    // {
    //     return view('kantorKas.show', compact('dataKantorKas','idkantorcabang'));
    // }
    public function show($idkantorcabang, $idkantorKas)
    {
        $dataKantorKas = DataKantorKas::find($idkantorKas); // Query manual
        // dd($kantorKas, $idkantorcabang);
        return view('kantorKas.show', compact('dataKantorKas', 'idkantorcabang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataKantorKas  $dataKantorKas
     * @return \Illuminate\Http\Response
     */
    public function edit($idkantorcabang, $idkantorKas)
    {
        $dataKantorKas = DataKantorKas::find($idkantorKas); // Query manual
        // dd($kantorKas, $idkantorcabang);
        return view('kantorKas.edit', compact('dataKantorKas', 'idkantorcabang'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataKantorKas  $dataKantorKas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idkantorcabang, $idkantorKas)
    {
        $dataKantorKas = DataKantorKas::find($idkantorKas); // Query manual

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
            if ($dataKantorKas->gambar) {
                Storage::disk('public')->delete($dataKantorKas->gambar);
            }

            // Simpan gambar baru ke storage/app/public/data_kantor_cabang
            $gambarPath = $gambar->store('data_kantor_kas', 'public');
            $input['gambar'] = $gambarPath;
        } else {
            unset($input['gambar']);
        }
        $input['kantor_cabang_id'] = $idkantorcabang;

        $dataKantorKas->update($input);

        return redirect()->route('data_kantor_kas.index', $idkantorcabang)
        ->with('message', 'Data kantor kas berhasil diedit');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKantorKas  $dataKantorKas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idkantorcabang, $idkantorKas)
    {
        $dataKantorKas = DataKantorKas::find($idkantorKas); // Query manual
        // Hapus file gambar dari disk storage jika ada
        if ($dataKantorKas->gambar) {
            Storage::disk('public')->delete($dataKantorKas->gambar);
        }

        // Hapus data dari database
        $dataKantorKas->delete();

        return redirect()->route('data_kantor_kas.index', $idkantorcabang)
        ->with('message', 'Data berhasil dihapus beserta gambarnya');

    }
}
