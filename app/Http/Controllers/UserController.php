<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Set role default user
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            \App\Models\UserLogin::create([
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'ip_address' => $request->ip(),
                'logged_in_at' => now(),
            ]);

            // Cek role dan arahkan
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); // sesuaikan dengan route admin
            }

            return redirect()->route('home'); // default untuk user
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }



    public function dashboard()
    {
        return view('user.dashboard'); // buat file ini nanti
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'address' => 'nullable|string|max:500',
        ]);

        $user = Auth::user(); // Gunakan Auth::user() setelah di-import

        $user->name = $request->name;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }


}
