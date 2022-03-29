<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $message = [
            'required' => 'Belum diisi!',
            'email' => 'Tidak valid!'
        ];
        $user = $request->validate([
                    'email' => 'required|email:dns',
                    'password' => 'required'
                ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with(['pesan' => 'email/password salah!', 'alert' => 'danger']);

    }

    public function logout()
    {
        Request()->session()->regenerateToken();
        Request()->session()->invalidate();
        Auth::logout();
        return redirect('/')->with(['pesan' => 'Berhasil logout!', 'alert' => 'dark']);
    }
}
