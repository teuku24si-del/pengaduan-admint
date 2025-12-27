<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\penilaian_layanan;

class Penilaian_layananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // Tentukan kolom yang bisa difilter (contoh: berdasarkan jumlah rating)
    $filterableColumns = ['rating'];

    // Query data dengan relasi pengaduan
    $data['datapenilaian_layanan'] = penilaian_layanan::with('pengaduan')
        ->filter($request, $filterableColumns)
        ->search($request) // Menggunakan scopeSearch yang sudah diperbaiki
        ->latest() // Mengurutkan dari yang terbaru
        ->paginate(10) // Pagination 10 data per halaman
        ->withQueryString(); // Menjaga parameter filter/search saat pindah halaman

    return view('pages.penilaian_layanan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $Pengaduan = Pengaduan::all();
          return view('pages.penilaian_layanan.create', compact('Pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([

           'pengaduan_id' => 'required',
            'rating' => 'required',
            'komentar' => 'required'


        ]);

        penilaian_layanan::create($request->all());

        return redirect()->route('penilaian_layanan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
