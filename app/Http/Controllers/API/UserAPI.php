<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserAPI extends Controller
{
    // Staff Kasir
    // Login
    public function kasirLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Mencari user dengan username dan password yang diberikan
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            if ($user->hasRole('staff_kasir')) {
                // Jika user ditemukan dan memiliki role staff_kasir
                if (Auth::attempt($credentials)) {
                    // Jika autentikasi berhasil
                    return response()->json([
                        'success' => true,
                        'message' => 'Login berhasil',
                    ]);
                } else {
                    // Jika autentikasi gagal
                    return response()->json([
                        'success' => false,
                        'message' => 'Username atau password salah',
                    ], 401);
                }
            } else {
                // Jika user tidak memiliki role "staff_kasir"
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses sebagai kasir',
                ], 403);
            }
        } else {
            // Jika autentikasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah',
            ], 401);
        }
    }

    // Register
    public function kasirRegister(Request $request)
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

        return response()->json(['success' => true, 'message' => 'Akun berhasil dibuat'], 200);
    }

    // Logout
    public function kasirLogout()
    {
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Logout berhasil'], 200);
    }

    // Staff Gudang
    // Login
    public function gudangLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Mencari user dengan username dan password yang diberikan
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            if ($user->hasRole('staff_gudang')) {
                // Jika user ditemukan dan memiliki role staff_gudang
                if (Auth::attempt($credentials)) {
                    // Jika autentikasi berhasil
                    return response()->json([
                        'success' => true,
                        'message' => 'Login berhasil',
                    ]);
                } else {
                    // Jika autentikasi gagal
                    return response()->json([
                        'success' => false,
                        'message' => 'Username atau password salah',
                    ], 401);
                }
            } else {
                // Jika user tidak memiliki role "staff_gudang"
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses sebagai gudang',
                ], 403);
            }
        } else {
            // Jika autentikasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah',
            ], 401);
        }
    }

    // Register
    public function gudangRegister(Request $request)
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

        return response()->json(['success' => true, 'message' => 'Akun berhasil dibuat'], 200);
    }

    // Logout
    public function gudangLogout()
    {
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Logout berhasil'], 200);
    }
}
