<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Staff Kasir
    // Login Form
    public function KasirLoginForm()
    {
        return view('staff_kasir.login');
    }

    // Login
    public function KasirLogin(Request $request)
    {
        // Mencari user dengan username dan password yang diberikan
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            if ($user->hasRole('staff_kasir')) {
                // Jika user ditemukan dan memiliki role staff_kasir
                if (Auth::attempt($credentials)) {
                    // Jika autentikasi berhasil
                    return redirect()->intended('/kasir');
                } else {
                    // Jika autentikasi gagal
                    return redirect()->back()->with('error', 'Username atau password salah');
                }
            } else {
                // Jika user ditemukan namun tidak memiliki role staff_kasir
                return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai staff kasir');
            }
        } else {
            // Jika user tidak ditemukan
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }

    // Register Form
    public function KasirRegistrationForm()
    {
        return view('staff_kasir.register');
    }

    // Register
    public function KasirRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
        ]);
    
        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->save();

        // Assign role to user
        $user->assignRole('staff_kasir');
    
        return redirect()->route('kasir.login')->with('success', 'Akun berhasil dibuat');
    }

    // Logout
    public function KasirLogout()
    {
        Auth::logout();
        return redirect('/kasir/login');
    }

    // Staff Gudang
    // Login Form
    public function GudangLoginForm()
    {
        return view('staff_gudang.login');
    }

    // Login
    public function GudangLogin(Request $request)
    {
        // Mencari user dengan username dan password yang diberikan
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            if ($user->hasRole('staff_gudang')) {
                // Jika user ditemukan dan memiliki role staff_gudang
                if (Auth::attempt($credentials)) {
                    // Jika autentikasi berhasil
                    return redirect()->intended('/kasir');
                } else {
                    // Jika autentikasi gagal
                    return redirect()->back()->with('error', 'Username atau password salah');
                }
            } else {
                // Jika user ditemukan namun tidak memiliki role staff_gudang
                return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai staff gudang');
            }
        } else {
            // Jika user tidak ditemukan
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }

    // Register Form
    public function GudangRegistrationForm()
    {
        return view('staff_gudang.register');
    }

    // Register
    public function GudangRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
        ]);
    
        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->save();

        // Assign role to user
        $user->assignRole('staff_gudang');
    
        return redirect()->route('gudang.login')->with('success', 'Akun berhasil dibuat');
    }

    // Logout
    public function GudangLogout()
    {
        Auth::logout();
        return redirect('/gudang/login');
    }
}
