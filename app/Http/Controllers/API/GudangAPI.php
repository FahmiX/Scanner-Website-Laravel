<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Barang;

class GudangAPI extends Controller
{
    // Tambah Barang
    public function tambahBarang(Request $request)
    {
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        $jumlah = $request->jumlah_barang;

        if ($barang) {
            $barang->stok_barang = $barang->stok_barang + $jumlah;
            $barang->save();

            return response()->json([
                'success' => true,
                'message' => 'Stok barang berhasil ditambahkan',
                'data' => $barang,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }
    }

    // Kurang Barang
    public function kurangBarang(Request $request)
    {
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        $jumlah = $request->jumlah_barang;

        if ($barang) {
            if ($barang->jumlah_barang >= $jumlah) {
                $barang->jumlah_barang = $barang->jumlah_barang - $jumlah;
                $barang->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Stok barang berhasil dikurangi',
                    'data' => $barang,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok barang tidak mencukupi',
                ], 404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }
    }
}

?>
