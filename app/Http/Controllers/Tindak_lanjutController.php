<?php

namespace App\Http\Controllers;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\tindak_lanjut;

class Tindak_lanjutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //     $data['datatindak_lanjut'] = tindak_lanjut::paginate(10);
		//  return view('pages.tindak_lanjut.index',$data);

        $filterableColumns = ['aksi'];

    $data['datatindak_lanjut'] = tindak_lanjut::with('pengaduan') // Eager load relasi
        ->filter($request, $filterableColumns)
        ->search($request) // Gunakan scopeSearch yang baru
        ->latest() // Urutkan dari yang terbaru
        ->paginate(10)
        ->withQueryString(); // Menjaga parameter URL saat pindah halaman pagination

    return view('pages.tindak_lanjut.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $Pengaduan = Pengaduan::all();
          return view('pages.tindak_lanjut.create', compact('Pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

           'pengaduan_id' => 'required',
            'petugas' => 'required',
            'aksi' => 'required',
            'catatan' => 'required'


        ]);

        tindak_lanjut::create($request->all());

        return redirect()->route('tindak_lanjut.index')->with('success', 'Data berhasil ditambahkan');
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
        $datatindak_lanjut = tindak_lanjut::with(['pengaduan'])->findOrFail($id);
        $pengaduan = Pengaduan::all();

        return view('pages.tindak_lanjut.edit', compact('datatindak_lanjut', 'pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'pengaduan_id' => 'required',
            'petugas' => 'required',
            'aksi' => 'required',
            'catatan' => 'required'
             ]);

       $tindak_lanjut = tindak_lanjut::findOrFail($id);
        $tindak_lanjut->update($request->all());

        return redirect()->route('tindak_lanjut.index')->with('success', 'Data tindak lanjut berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Cari data tindak lanjut berdasarkan ID
            $tindak_lanjut = tindak_lanjut::findOrFail($id);

            // Hapus data pengaduan
            $tindak_lanjut->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('tindak_lanjut.index')->with('success', 'Data tindak lanjut berhasil dihapus!');
    }
}
