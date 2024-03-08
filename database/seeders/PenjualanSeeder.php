<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $jumlah_transaksi = 10;

        // for ($i = 1; $i <= $jumlah_transaksi; $i++) { 
        //     $data = [
        //         'user_id' => rand(1,3),
        //         'pembeli' => 'Si fulan ' . $i,
        //         'penjualan_kode' => 'PJL' . str_pad($i, 3, 0, STR_PAD_LEFT),
        //         'penjualan_tanggal' => now(),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        //     DB::table('t_penjualan')->insert($data);
        // }

        $data = [
            [
                'user_id' => 3,
                'pembeli' => 'Dina',
                'penjualan_kode' => 'PJL001',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Dina',
                'penjualan_kode' => 'PJL002',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Dina',
                'penjualan_kode' => 'PJL003',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Krisna',
                'penjualan_kode' => 'PJL004',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Krisna',
                'penjualan_kode' => 'PJL005',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Raffy',
                'penjualan_kode' => 'PJL006',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Raffy',
                'penjualan_kode' => 'PJL007',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Raffy',
                'penjualan_kode' => 'PJL008',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Putri',
                'penjualan_kode' => 'PJL009',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Putri',
                'penjualan_kode' => 'PJL010',
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
