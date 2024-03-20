<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
        // $data = [
        //     'kategori_kode' => 'SMK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];
        // DB::table('m_kategori') -> insert($data);
        // return 'Insert data baru berhasil';

        // update
        // $row = DB::table('m_kategori')->where('kategori_kode', 'SMK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // delete
        // $row = DB::table('m_kategori')->where('kategori_kode', 'SMK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // menampilkan data
        // $data = DB::table('m_kategori')->get();
        // return view('kategori', ['data' => $data]);
    }
}
