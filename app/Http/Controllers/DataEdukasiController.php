<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataEdukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataEdukasiController extends Controller
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
            $edukasis = DataEdukasi::when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%")
                            ->orWhere('keterangan', 'like', "%{$search}%");
            })->orderBy('updated_at', 'desc')->paginate(10);
    
            // Mengirimkan data produk dan kata kunci pencarian ke view
            return view('edukasis.index', compact('edukasis', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('edukasis.create');

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
            'tanggal' => 'required|date', // Tambahkan validasi untuk tanggal
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        // Mendapatkan nama hari dari tanggal
        $tanggal = Carbon::parse($request->input('tanggal'));
        $input['hari'] = $tanggal->translatedFormat('l'); // Mendapatkan nama hari dalam bahasa lokal

        if ($gambar = $request->file('gambar')) {
            // Simpan gambar ke storage/app/public/data_edukasi
            $gambarPath = $gambar->store('data_edukasi', 'public');
            $input['gambar'] = $gambarPath;
        }

        DataEdukasi::create($input);

        return redirect('/data_edukasi')->with('message', 'Data edukasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataEdukasi  $dataEdukasi
     * @return \Illuminate\Http\Response
     */
    public function show(DataEdukasi $dataEdukasi)
    {
        return view('edukasis.show', compact('dataEdukasi'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataEdukasi  $dataEdukasi
     * @return \Illuminate\Http\Response
     */
    public function edit(DataEdukasi $dataEdukasi)
    {
        return view('edukasis.edit', compact('dataEdukasi'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataEdukasi  $dataEdukasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataEdukasi $dataEdukasi)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image',
            'tanggal' => 'required|date', // Tambahkan validasi untuk tanggal
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        // Mendapatkan nama hari dari tanggal yang diupdate
        $tanggal = Carbon::parse($request->input('tanggal'));
        $input['hari'] = $tanggal->translatedFormat('l'); // Mendapatkan nama hari

        if ($gambar = $request->file('gambar')) {
            // Hapus gambar lama jika ada
            if ($dataEdukasi->gambar) {
                Storage::disk('public')->delete($dataEdukasi->gambar);
            }

            // Simpan gambar baru ke storage/app/public/data_edukasi
            $gambarPath = $gambar->store('data_edukasi', 'public');
            $input['gambar'] = $gambarPath;
        } else {
            unset($input['gambar']);
        }

        $dataEdukasi->update($input);

        return redirect('/data_edukasi')->with('message', 'Data edukasi berhasil diedit dan gambar lama dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataEdukasi  $dataEdukasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataEdukasi $dataEdukasi)
    {
         // Hapus file gambar dari disk storage jika ada
        if ($dataEdukasi->gambar) {
            Storage::disk('public')->delete($dataEdukasi->gambar);
        }

        // Hapus data dari database
        $dataEdukasi->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_edukasi')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }
}
