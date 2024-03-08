<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Sampo',
                'harga_beli' => 35000,
                'harga_jual' => 38000,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Sabun',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'BRG003',
                'barang_nama' => 'Kulkas',
                'harga_beli' => 4000000,
                'harga_jual' => 4400000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'BRG004',
                'barang_nama' => 'TV',
                'harga_beli' => 5000000,
                'harga_jual' => 5500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Beras',
                'harga_beli' => 50000,
                'harga_jual' => 57000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Gula',
                'harga_beli' => 11000,
                'harga_jual' => 13000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Donat',
                'harga_beli' => 4500,
                'harga_jual' => 6000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Roti',
                'harga_beli' => 18000,
                'harga_jual' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Fanta',
                'harga_beli' => 6000,
                'harga_jual' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Coca-cola',
                'harga_beli' => 6000,
                'harga_jual' => 7500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
