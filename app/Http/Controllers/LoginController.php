<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('pengguna.login');
    }
    public function post_login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($data)) {
            $request->session()->flash('Welcome', 'Selamat datang, ' . Auth::user()->level);
            return redirect('dasboard');
        } else {
            return redirect()->route('login')->with('error', 'Silahkan Coba Lagi');
        }
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::logout();
        return redirect()->route('login')->with('succes', 'Kamu Berhasil Logout');
    }
}
