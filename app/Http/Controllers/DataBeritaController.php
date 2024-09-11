<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataBerita;
use Illuminate\Http\Request;

class DataBeritaController extends Controller
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
            $beritas = DataBerita::when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%")
                            ->orWhere('keterangan', 'like', "%{$search}%");
            })->orderBy('updated_at', 'desc')->paginate(10);
    
            // Mengirimkan data produk dan kata kunci pencarian ke view
            return view('beritas.index', compact('beritas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beritas.create');

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
            $lokasiFile = 'assets/data_berita/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        }

        DataBerita::create($input);

        return redirect('/data_berita')->with('message', 'Data berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataBerita  $dataBerita
     * @return \Illuminate\Http\Response
     */
    public function show(DataBerita $dataBerita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataBerita  $dataBerita
     * @return \Illuminate\Http\Response
     */
    public function edit(DataBerita $dataBerita)
    {
        return view('beritas.edit', compact('dataBerita'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataBerita  $dataBerita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataBerita $dataBerita)
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
            $lokasiFile = 'assets/data_berita/';
            
            // Hapus gambar lama jika ada
            $gambarLamaPath = public_path($lokasiFile . $dataBerita->gambar);
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

        $dataBerita->update($input);

        return redirect('/data_berita')->with('message', 'Data berita berhasil diedit dan gambar lama dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataBerita  $dataBerita
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataBerita $dataBerita)
    {
        // Lokasi file gambar
        $gambarPath = public_path('assets/data_berita/' . $dataBerita->gambar);

        // Cek apakah file gambar tersebut ada di folder
        if (file_exists($gambarPath)) {
            // Jika ada, hapus file gambar
            unlink($gambarPath);
        }

        // Hapus data dari database
        $dataBerita->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_berita')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }
}
