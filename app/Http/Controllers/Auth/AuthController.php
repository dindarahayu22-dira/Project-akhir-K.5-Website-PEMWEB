<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
            'role'     => ['required', 'in:buyer,seller'],
        ], [
            'login.required'    => 'Email atau NIM wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $field = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        if (! Auth::attempt([
            $field     => $data['login'],
            'password' => $data['password'],
            'role'     => $data['role'],
        ], $request->boolean('remember'))) {
            return back()->withInput($request->only('login', 'role'))
                ->withErrors(['login' => 'Akun tidak ditemukan untuk peran ini, atau password salah.']);
        }

        $request->session()->regenerate();

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return redirect()->intended($user && $user->isSeller() ? '/seller' : '/home');
    }

    public function register(Request $request)
    {
        $role = $request->input('role') === 'seller' ? 'seller' : 'buyer';

        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'nim'      => [$role === 'buyer' ? 'required' : 'nullable', 'string', 'max:20', 'unique:users,nim'],
            'tenant'   => [$role === 'seller' ? 'required' : 'nullable', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'nim.required'       => 'NIM wajib diisi untuk akun Pembeli.',
            'nim.unique'         => 'NIM sudah terdaftar.',
            'tenant.required'    => 'Nama kantin wajib diisi untuk akun Penjual.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'password.min'       => 'Password minimal 8 karakter.',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $role,
            'nim'      => $role === 'buyer' ? $data['nim'] : null,
        ]);

        if ($role === 'seller') {
            Tenant::create([
                'user_id'     => $user->id,
                'name'        => $data['tenant'],
                'description' => 'Makanan & minuman kampus',
                'status' => 'closed',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect($role === 'seller' ? '/seller' : '/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}