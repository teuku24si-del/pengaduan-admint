<?php

namespace App\Http\Controllers;

use App\Models\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
        $request->validate([
            'files' => 'required',
            // Sesuaikan validasi dengan topik. Untuk Aset bisa gambar/dokumen
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
            'ref_table' => 'required',
            'ref_id' => 'required'
        ]);

        $path = public_path('uploads');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $mimeType = $file->getClientMimeType(); //

                $file->move($path, $filename);

                media::create([
                    'ref_table' => $request->ref_table,
                    'ref_id'    => $request->ref_id,
                    'file_name' => $filename, //
                    'mime_type' => $mimeType, //
                    'caption'   => $file->getClientOriginalName(), // Default caption pakai nama asli
                    'sort_order'=> 0
                ]);
            }
            return back()->with('success', 'File berhasil diupload!');
        }
        return back()->with('error', 'Gagal upload file.');
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
        $media = Media::findOrFail($id);

        // Hapus fisik file
        $filePath = public_path('uploads/' . $media->file_name);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $media->delete();
        return back()->with('success', 'File berhasil dihapus!');
}

}
