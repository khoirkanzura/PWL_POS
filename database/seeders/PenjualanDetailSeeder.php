<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $detail_id = 1;

        $barang_ids = DB::table('m_barang') ->pluck('barang_id')->toArray();

        if (empty($barang_ids)){
            return;
        }

        // Loop untuk 10 transaksi penjualan
        for ($i = 1; $i <= 10; $i++) {
            // 3 barang untuk setiap transaksi penjualan
            for ($j = 1; $j <= 3; $j++) {
                $barang_id = $barang_ids[array_rand($barang_ids)];
                $harga = DB::table('m_barang')->where('barang_id', $barang_id)->value('harga_jual');
                $jumlah = rand(1, 5); // Jumlah barang antara 1 sampai 5

                if ($harga === null){
                    continue;
                }

                $jumlah = rand(1,5);

                $data[] = [
                    'detail_id' => $detail_id,
                    'penjualan_id' => $i, // Menghubungkan dengan transaksi ke-i
                    'barang_id' => $barang_id,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                ];

                $detail_id++;
            }
        }

        if (!empty($data)){
        DB::table('t_penjualan_detail')->insert($data);
        }
    }
}
