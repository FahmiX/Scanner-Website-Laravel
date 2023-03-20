<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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

    public function transaksiKasir(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'QR Code tidak boleh kosong'], 400);
        }

        try {
            $kode_barang = $request->qr_code;
            $barang = Barang::where('kode_barang', $kode_barang)->first();
            if ($barang) {
                $barang->stok_barang = $barang->stok_barang - 1;
                $barang->save();
            } else {
                return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan'], 400);
            }
            return response()->json(['success' => true, 'message' => 'Transaksi berhasil'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Transaksi gagal', 'data' => $th], 400);
        }
    }
}
