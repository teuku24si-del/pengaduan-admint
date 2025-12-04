<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'role' => 'required|in:admin,staff,kades', // tambahkan validasi role
        'password' => 'required|min:8|confirmed',
    ]);

    // Simpan data
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role, // simpan role
        'password' => Hash::make($request->password), // Hash password
    ];

    User::create($data);

    return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
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
        $data['user'] = User::findOrFail($id); // Ubah dari dataUser menjadi user
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|in:admin,staff,kades', // tambahkan validasi role
        'password' => 'nullable|min:8|confirmed', // Password optional
    ]);

    // Update data
    $data = [
        'name' => $request->name,
        'role' => $request->role, // update role
        'email' => $request->email,
    ];

    // Jika password diisi, update password
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('user.index')->with('success', 'Data User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $User = User::findOrFail($id);
        $User->delete();

        return redirect()->route('user.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
