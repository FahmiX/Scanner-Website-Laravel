<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Controllers\QRCodeController;

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
        $barang = $barang->getABarang($id);

        return view('staff_gudang.barang_detail', compact('barang'));
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
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->stok_barang = $request->stok_barang;
        $barang->deskripsi_barang = $request->deskripsi_barang;

        // Upload Gambar
        $image = $request->file('gambar_barang');
        $newImageName = date('YmdHis') . '-' . $image->getClientOriginalName();
        $image->move(public_path('images/barang'), $newImageName);
        $barang->gambar_barang = $newImageName;

        // Generate QR Code
        $qrcode = new QRCodeController();
        $qrimage = $qrcode->generateQRCode($barang->kode_barang, $barang->nama_barang);
        $barang->qrcode_barang = $qrimage;

        // Save ke database
        $barang->createBarang($barang->toArray());

        return redirect()->route('gudang.barang_display')->with('success', 'Barang berhasil ditambahkan');
    }

    public function editBarang($id)
    {
        $barang = new Barang();
        $barang = $barang->getABarang($id);

        return view('staff_gudang.barang_edit', compact('barang'));
    }

    public function updateBarang($id, Request $request)
    {
        $barang = new Barang();
        $oldBarang = $barang->getABarang($id);
        $newBarang = $request->all();

        // Update gambar
        if ($request->hasFile('gambar_barang')) {
            // Upload New Image
            $image = $request->file('gambar_barang');
            $newImageName = date('YmdHis') . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/barang'), $newImageName);
            $newBarang['gambar_barang'] = $newImageName;

            // Delete Old Image
            if (file_exists('images/barang/' . $oldBarang->gambar_barang)) {
                unlink('images/barang/' . $oldBarang->gambar_barang);
            }
        } else {
            $newBarang['gambar_barang'] = $oldBarang->gambar_barang;
        }

        // Update data
        $barang->updateBarang($newBarang, $id);

        return redirect()->route('gudang.barang_display')->with('success', 'Barang berhasil diubah');
    }

    public function deleteBarang($id)
    {
        $barang = new Barang();

        // Delete gambar
        $oldBarang = $barang->getABarang($id);

        if (file_exists('images/barang/' . $oldBarang->gambar_barang)) {
            unlink('images/barang/' . $oldBarang->gambar_barang);
        }

        if (file_exists('images/barang_qrcode/' . $oldBarang->qrcode_barang)) {
            unlink('images/barang_qrcode/' . $oldBarang->qrcode_barang);
        }

        // Delete data
        $barang->deleteBarang($id);

        return redirect()->route('gudang.barang_display')->with('success', 'Barang berhasil dihapus');
    }

    public function searchBarang(Request $request)
    {
        $barang = new Barang();
        $data = $barang->searchBarang($request->search);

        return view('staff_gudang.barang_display', compact('data'));
    }
}
