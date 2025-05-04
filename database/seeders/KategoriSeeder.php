<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'ELEC', 'kategori_nama' => 'Elektronik'],
             ['kategori_id' => 2, 'kategori_kode' => 'FASH', 'kategori_nama' => 'Fashion'],
             ['kategori_id' => 3, 'kategori_kode' => 'FOOD', 'kategori_nama' => 'Makanan'],
             ['kategori_id' => 4, 'kategori_kode' => 'TOOL', 'kategori_nama' => 'Peralatan'],
             ['kategori_id' => 5, 'kategori_kode' => 'BOOK', 'kategori_nama' => 'Buku'],
            ['kategori_id' => 6, 'kategori_kode' => 'CML', 'kategori_nama' => 'Cemilan'],    // Tambahan
            ['kategori_id' => 7, 'kategori_kode' => 'MNR', 'kategori_nama' => 'Minuman Ringan'],      // Tambahan
        ];

        // Insert ke tabel m_kategori
        DB::table('m_kategori')->insert($data);
    }
}