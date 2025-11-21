<?php

namespace App\Http\Controllers;

use App\Models\kategori_pengaduan;
use Illuminate\Http\Request;

class Kategori_pengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        

          //daftar kolom yang bisa di filter
        $filterableColumns = ['prioritas'];

        $searchableColumns = ['nama'];

        $data['datakategori_pengaduan'] = kategori_pengaduan:: filter($request,$filterableColumns)
                                             ->search($request,$searchableColumns)
                                             ->paginate(5)->withQueryString();
         return view('pages.kategori_pengaduan.index',$data);

        //menggunakan scope filter
        $pageData['datakategori_pengaduan'] = kategori_pengaduan::filter($request, $filterableColumns)->paginate(5);
        return view('pages.kategori_pengaduan.index', $pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kategori_pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
         $data['nama'] = $request->nama;
		$data['sla_hari'] = $request->sla_hari;
		$data['prioritas'] = $request->prioritas;

        kategori_pengaduan::create($data);


		return redirect()->route('kategori_pengaduan.index')->with('success','Penambahan Data Berhasil!');
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
         $data['datakategori_pengaduan'] = kategori_pengaduan::findOrFail($id);
    return view('pages.kategori_pengaduan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'sla_hari' => 'required',
            'prioritas' => 'required',

             ]);

        $warga = kategori_pengaduan::findOrFail($id);
        $warga->update($request->all());

        return redirect()->route('kategori_pengaduan.index')->with('success', 'Data kategori pengaduan berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $kategori_pengaduan = kategori_pengaduan::findOrFail($id);
        $kategori_pengaduan->delete();

        return redirect()->route('kategori_pengaduan.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
