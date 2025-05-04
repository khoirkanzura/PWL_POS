<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = PenjualanModel::with(['user', 'details.barang'])->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    
    public function show($transaksi)
    {
        $penjualan = PenjualanModel::with(['user', 'details.barang'])->findOrFail($transaksi);
        return response()->json([
            'success' => true,
            'data' => $penjualan
        ]);
    }

    /** POST /api/transaksi */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required|string|max:100',
            'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:m_barang,barang_id',
            'items.*.jumlah' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $transaksi = PenjualanModel::create([
            'user_id' => $data['user_id'],
            'pembeli' => $data['pembeli'],
            'penjualan_kode' => $data['penjualan_kode'],
            'penjualan_tanggal' => $data['penjualan_tanggal'],
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('transaksi', 'public');
            $transaksi->update(['foto' => $imagePath]);
        }

        // Tambahkan item transaksi
        foreach ($data['items'] as $item) {
            $transaksi->details()->create([
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
                'harga' => \App\Models\BarangModel::find($item['barang_id'])->harga_jual,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $transaksi->load(['user', 'details.barang']),
            'message' => 'Transaksi berhasil dibuat'
        ], 201);
    }

    /** PUT /api/transaksi/{transaksi} */
    public function update(Request $request, $transaksi)
    {
        $transaksi = PenjualanModel::findOrFail($transaksi);

        $validator = Validator::make($request->all(), [
            'pembeli' => 'sometimes|required|string|max:100',
            'penjualan_kode' => 'sometimes|required|string|unique:t_penjualan,penjualan_kode,'.$transaksi->penjualan_id.',penjualan_id',
            'penjualan_tanggal' => 'sometimes|required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $transaksi->update($data);

        // Handle foto update
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($transaksi->foto) {
                Storage::disk('public')->delete($transaksi->foto);
            }
            
            // Simpan foto baru
            $imagePath = $request->file('foto')->store('transaksi', 'public');
            $transaksi->update(['foto' => $imagePath]);
        }

        return response()->json([
            'success' => true,
            'data' => $transaksi->load(['user', 'details.barang']),
            'message' => 'Transaksi berhasil diperbarui'
        ]);
    }

    /** DELETE /api/transaksi/{transaksi} */
    public function destroy($transaksi)
    {
        $transaksi = PenjualanModel::findOrFail($transaksi);
        
        // Hapus foto jika ada
        if ($transaksi->foto) {
            Storage::disk('public')->delete($transaksi->foto);
        }

        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }
}