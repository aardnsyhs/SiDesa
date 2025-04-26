<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('dashboard');
        }

        return view('pages.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
            'captcha' => ['required', 'captcha'],
        ]);

        $usernameInput = $credentials['username'];

        if (ctype_digit($usernameInput) && strlen($usernameInput) === 16) {
            $loginField = 'nik';
        } else {
            $loginField = 'username';
        }

        if (
            Auth::attempt([
                $loginField => $usernameInput,
                'password' => $credentials['password']
            ])
        ) {
            $request->session()->regenerate();

            $authUser = Auth::user()->load('role');

            if ($authUser->status === 'submitted') {
                Auth::logout();
                return back()->withErrors([
                    'general' => 'Akun Anda masih menunggu persetujuan admin.'
                ]);
            } elseif ($authUser->status === 'rejected') {
                Auth::logout();
                return back()->withErrors([
                    'general' => 'Akun Anda ditolak admin.'
                ]);
            }

            if ($authUser->role->name === 'admin') {
                return redirect()->intended('dashboard');
            } elseif ($authUser->role->name === 'user') {
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'general' => 'Role tidak dikenali, hubungi administrator.'
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Terjadi kesalahan, periksa kembali username/nik dan password Anda.',
        ])->onlyInput('username');
    }


    public function logout(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }

    public function registerView()
    {
        if (Auth::check()) {
            return redirect()->intended('dashboard');
        }

        return view('pages.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'nik' => 'required|size:16|unique:users',
            'nama' => 'required|string|max:100',
            'telepon' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = new User();
        $user->id = Str::uuid();
        $user->nik = $request->nik;
        $user->nama = $request->nama;
        $user->telepon = $request->telepon;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = Role::where('name', 'user')->first()->id;
        $user->status = 'submitted';
        $user->save();

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Tunggu persetujuan admin.');
    }
}
