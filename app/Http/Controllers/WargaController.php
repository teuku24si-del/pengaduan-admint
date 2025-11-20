<?php

namespace App\Http\Controllers;




use App\Models\warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['datawarga'] = warga::paginate(10);
		return view('pages.warga.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //dd($request->all());

        $data['nama'] = $request->nama;
		$data['agama'] = $request->agama;
		$data['pekerjaan'] = $request->pekerjaan;
		$data['jenis_kelamin'] = $request->jenis_kelamin;
		$data['email'] = $request->email;
		$data['No_Hp'] = $request->No_Hp;

		warga::create($data);


		return redirect()->route('warga.index')->with('success','Penambahan Data Berhasil!');

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
         $data['datawarga'] = warga::findOrFail($id);
    return view('pages.warga.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'nullable|email',
            'No_Hp' => 'required',


        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $warga = warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
