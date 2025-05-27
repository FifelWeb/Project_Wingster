<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Function Halaman login
    public function index(){
        return view('auth.login');
    }

    public function verify(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.index');
            } elseif ($user->role === 'customer') {
                return redirect()->route('home.index');
            } else {
                Auth::logout();
                return redirect()->route('auth.login')->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }
    }
    // Menampilkan halaman register
    public function register()
    {
        return view('auth.register');
    }

    // Proses registrasi (POST)
    public function registerPost(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Simpan user baru ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // default role
        ]);

        // Tidak login otomatis → langsung redirect ke login
        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
