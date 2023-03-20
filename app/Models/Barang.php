<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'harga_barang',
        'stok_barang',
        'deskripsi_barang',
        'gambar_barang',
        'qrcode_barang',
    ];

    public function getAllBarang()
    {
        // Query
        $query = DB::select('SELECT * FROM barang');

        // Return
        return $query;
    }

    public function getABarang($id)
    {
        // Query
        $query = DB::select('SELECT * FROM barang WHERE id = ?', [$id]);

        // Return the first row as an object
        return count($query) ? $query[0] : null;
    }

    public function createBarang($data)
    {
        // Query
        $query = DB::insert('INSERT INTO barang (nama_barang, kode_barang, harga_barang, stok_barang, deskripsi_barang, gambar_barang, qrcode_barang) VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $data['nama_barang'],
            $data['kode_barang'],
            $data['harga_barang'],
            $data['stok_barang'],
            $data['deskripsi_barang'],
            $data['gambar_barang'],
            $data['qrcode_barang'],
        ]);

        // Return
        return $query;
    }

    public function updateBarang($data, $id)
    {
        // Query
        $query = DB::update('UPDATE barang SET nama_barang = ?, kode_barang = ?, harga_barang = ?, stok_barang = ?, deskripsi_barang = ?, gambar_barang = ? WHERE id = ?', [
            $data['nama_barang'],
            $data['kode_barang'],
            $data['harga_barang'],
            $data['stok_barang'],
            $data['deskripsi_barang'],
            $data['gambar_barang'],
            $id,
        ]);

        // Return
        return $query;
    }

    public function deleteBarang($id)
    {
        // Query
        $query = DB::delete('DELETE FROM barang WHERE id = ?', [$id]);

        // Return
        return $query;
    }

    public function searchBarang($keyword)
    {
        // Query
        $query = DB::select('SELECT * FROM barang WHERE nama_barang LIKE ?', ["%$keyword%"]);

        // Return
        return $query;
    }

    public function getBarangByKode($kode_barang)
    {
        // Query
        $query = DB::select('SELECT * FROM barang WHERE kode_barang = ?', [$kode_barang]);

        // Return
        return $query;
    }
}
