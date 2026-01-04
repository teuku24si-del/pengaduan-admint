<?php

namespace App\Http\Controllers;

use App\Models\media;
use App\Models\warga;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\kategori_pengaduan;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //   $data['dataPengaduan'] = Pengaduan::paginate(10);
		// return view('pages.Pengaduan.index',$data);

         // Kolom yang bisa difilter
    $filterableColumns = ['status'];

    // Kolom yang bisa dicari (sekarang tidak perlu array karena menggunakan whereHas)
    $searchableColumns = ['no_tiket']; // Tetap diisi minimal satu untuk backward compatibility

    // Query dengan filter dan search
    $data['dataPengaduan'] = Pengaduan::with(['warga', 'kategori'])
        ->filter($request, $filterableColumns)
        ->search($request, $searchableColumns) // Parameter kedua masih dikirim tapi tidak digunakan
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('pages.Pengaduan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = kategori_pengaduan::all();
        $warga = warga::all();
        //return view('pages.Pengaduan.create');

        // PERBAIKAN: Kirim variable ke view
         return view('pages.Pengaduan.create', compact('kategori', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

           'no_tiket' => 'required|unique:pengaduan',
            'warga_id' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'lokasi_text' => 'required',
            'rt' => 'required',
            'rw' => 'required'

        ]);

        Pengaduan::create($request->all());

        return redirect()->route('Pengaduan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $Pengaduan)
    {
         // Ambil data media yang terkait dengan kategori pengaduan
    $files = media::where('ref_table', 'Pengaduan')
                  ->where('ref_id', $Pengaduan->pengaduan_id)
                  ->latest()
                  ->get();

    return view('pages.Pengaduan.show', compact('Pengaduan', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataPengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id);
        $kategori = Kategori_Pengaduan::all();
        $warga = Warga::all();

        return view('pages.Pengaduan.edit', compact('dataPengaduan', 'kategori', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'no_tiket' => 'required|max:100',
            'warga_id' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'lokasi_text' => 'required',
            'rt' => 'required',
            'rw' => 'required',
             ]);

       $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update($request->all());

        return redirect()->route('Pengaduan.index')->with('success', 'Data pengaduan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data pengaduan berdasarkan ID
            $pengaduan = Pengaduan::findOrFail($id);

            // Hapus data pengaduan
            $pengaduan->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('Pengaduan.index')->with('success', 'Data pengaduan berhasil dihapus!');
    }
}
