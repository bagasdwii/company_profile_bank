<?php

namespace App\Http\Controllers;

use App\Models\DataProfile;
use Illuminate\Http\Request;

class DataProfileController extends Controller
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
       $profiles = DataProfile::when($search, function ($query, $search) {
           return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('keterangan', 'like', "%{$search}%");
        })->orderBy('updated_at', 'desc')->paginate(10);

       // Mengirimkan data produk dan kata kunci pencarian ke view
        return view('profiles.index', compact('profiles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
        
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
            $lokasiFile = 'assets/data_profile/';
            // Gunakan timestamp untuk nama file agar unik
            $gambarNama = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($lokasiFile, $gambarNama);
            $input['gambar'] = $gambarNama;
        }
    
        DataProfile::create($input);
    
        return redirect('/data_profile')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function show(DataProfile $dataProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(DataProfile $dataProfile)
    {
        return view('profiles.edit', compact('dataProfile'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataProfile $dataProfile)
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
            $lokasiFile = 'assets/data_profile/';
            $gambarLamaPath = public_path($lokasiFile . $dataProfile->gambar);
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
    
        $dataProfile->update($input);
    
        return redirect('/data_profile')->with('message', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataProfile  $dataProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataProfile $dataProfile)
    {
        // Lokasi file gambar
        $gambarPath = public_path('assets/data_profile/' . $dataProfile->gambar);

        // Cek apakah file gambar tersebut ada di folder
        if (file_exists($gambarPath)) {
            // Jika ada, hapus file gambar
            unlink($gambarPath);
        }

        // Hapus data dari database
        $dataProfile->delete();

        // Redirect dengan pesan sukses
        return redirect('/data_profile')->with('message', 'Data berhasil dihapus beserta gambarnya');
    }
}
