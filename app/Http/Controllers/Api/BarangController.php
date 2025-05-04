<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = BarangModel::with('kategori')->get();
        return response()->json([
            'success' => true,
            'data' => $barangs
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required', // Hapus exists validation
            'barang_kode' => 'required|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // Jika validasi gagal
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload gambar
        $imagePath = $request->file('foto')->store('barang', 'public');

        // Create barang
        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'foto' => $imagePath, // Simpan path gambar yang diupload
        ]);

        return response()->json([
            'success' => true,
            'data' => $barang,
            'message' => 'Barang berhasil dibuat'
        ], 201);
    }

    public function show(BarangModel $barang)
    {
        return response()->json([
            'success' => true,
            'data' => $barang->load('kategori')
        ]);
    }

    public function update(Request $request, BarangModel $barang)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'sometimes|exists:m_kategori,kategori_id',
            'barang_kode' => 'sometimes|unique:m_barang,barang_kode,'.$barang->barang_id.',barang_id',
            'barang_nama' => 'sometimes|string|max:100',
            'harga_beli' => 'sometimes|numeric|min:0',
            'harga_jual' => 'sometimes|numeric|min:0', // Diperbaiki dari 'harga_jual' yang salah ketik
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('foto');

        // Handle image update
        if ($request->hasFile('foto')) {
            // Delete old image
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            
            // Store new image
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang->update($data);

        return response()->json([
            'success' => true,
            'data' => $barang,
            'message' => 'Barang berhasil diperbarui'
        ]);
    }

    public function destroy(BarangModel $barang)
    {
        // Delete image if exists
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }
}