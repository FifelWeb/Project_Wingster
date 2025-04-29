<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Function Halaman login
    public function index(){
        return view('auth.login');
    }

    public function verify(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('user')->attempt(['email'=> $request->email, 'password' => $request->password])){
            $user = Auth::guard('user')->user();

            /*// cek apakah user sudah diaktivasi
            if (!$user->is_active) {
                Auth::guard('user')->logout();
                return redirect()->route('auth.index')->with('pesan', 'Akun belum diaktivasi. Silakan cek email Anda untuk aktivasi akun.');
            }*/
            Auth::login($user);
            return redirect()->intended('/dashboard');
        }else{
            return redirect(route('auth.index'))->with('pesan','Kombinasi email dan password salah');
        }
    }
}
