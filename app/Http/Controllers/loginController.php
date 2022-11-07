<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return redirect('/');
        }
    }

    public function proceslogin(Request $request)
    {
        // dd($request['email']);
        $data = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        if (Auth::Attempt($data)) {
            $request->session()->regenerate();
            return redirect('dashboard');
        } else {
            return back()->with('gagal', 'Login gagal');
        }
    }

    public function logouth()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda Berhasil Logouth');
    }
}
