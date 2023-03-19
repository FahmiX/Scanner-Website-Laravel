<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class StaffGudangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:staff_gudang']);
    }

    public function index()
    {
        return view('staff_gudang.index');
    }

    public function displayBarang()
    {
        $barang = new Barang();
        $data = $barang->getAllBarang();
        
        return view('staff_gudang.barang_display', compact('data'));
    }

    public function detailBarang($id)
    {
        $barang = new Barang();
        $data = $barang->getABarang($id);

        return view('staff_gudang.barang_detail', compact('data'));
    }

    public function createBarang()
    {
        return view('staff_gudang.barang_create');
    }

    public function storeBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'harga_barang' => 'required',
            'stok_barang' => 'required',
            'deskripsi_barang' => 'required',
            'gambar_barang' => 'required',
        ]);

        $barang = new Barang();
        $barang->createBarang($request->all());

        return redirect()->route('gudang.barang_display')->with('success', 'Barang berhasil ditambahkan');
    }

    public function editBarang($id)
    {
        $barang = new Barang();
        $data = $barang->getABarang($id);

        return view('staff_gudang.barang_edit', compact('data'));
    }

    public function updateBarang($id, Request $request)
    {
        $barang = new Barang();
        $barang->updateBarang($request->all(), $id);

        return redirect()->route('gudang.barang_edit')->with('success', 'Barang berhasil diubah');
    }

    public function deleteBarang($id)
    {
        $barang = new Barang();
        $barang->deleteBarang($id);

        return redirect()->route('gudang.barang_display')->with('success', 'Barang berhasil dihapus');
    }
}
