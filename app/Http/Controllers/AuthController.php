<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function regis()
    {
        return view('pages.Auth.register');
    }

    /**
     * Store a newly created resource in storage - untuk LOGIN
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        // Coba login dengan email atau username
        $credentials = $request->only('name', 'password');

        // Cari user berdasarkan email atau username
        $user = User::where('email', $credentials['name'])
                    ->orWhere('name', $credentials['name'])
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Login berhasil
            Auth::login($user);

            // Redirect ke dashboard
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Store register - untuk REGISTER
     */
    public function storeRegister(Request $request)
    {
       // 1. Validasi
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // Validasi role harus salah satu dari 3 ini
            'role'     => 'required|in:admin,staff,kades',
        ]);

        // 2. Simpan ke Database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role, // Ambil dari inputan user
        ]);

        // 3. Redirect ke Halaman Login
        return redirect()->route('Auth.index')->with('success', 'Registrasi berhasil! Silakan Login.');
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
