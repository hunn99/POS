<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LevelModel;


class LevelController extends Controller
{
    public function index()
    {
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        // update
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // delete
        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // menampilkan data
        // $data = DB::select('select * from m_level');
        // return view ('level', ['data' => $data] );

        // $data = [
        //     'level_kode' => 'CUS',
        //     'level_nama' => 'Customer',

        // ];
        // LevelModel::insert($data); //tambahkan data ke tabel m_level
        // // coba akses model LevelModel
        // $level = LevelModel::all(); //ambil semua data dari tabel m_level
        // return view('level', ['data' => $level]);
    }
}
