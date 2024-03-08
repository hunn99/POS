<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $jumlah_barang = 10;

        // for ($i = 1; $i <= $jumlah_barang; $i++) { 
        //     $data = [
        //         'barang_id' => rand (1, 10),
        //         'user_id' => rand(1, 3),
        //         'stok_tanggal' => now(),
        //         'stok_jumlah' => rand(50, 100),
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ];
        //     DB::table('t_stok')->insert($data);
        // }

        $data = [
            [
                'barang_id' => 1,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 134,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 2,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 157,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 3,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 4,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 32,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 5,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 6,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 235,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 7,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 8,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 9,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 48,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 10,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 79,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('t_stok')->insert($data);
    }
}
