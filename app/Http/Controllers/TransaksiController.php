<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\DetailTransaksiModel;
use App\Models\StokModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = UserModel::all();

        $breadscrumb = (object) [
            'title' => 'Daftar Transaksi',
            'list' => ['Home', 'Transaksi']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'transaksi';

        return view('transaksi.index', ['user' => $user, 'breadcrumb' => $breadscrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $transaksis = TransaksiModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->with('user');

        return DataTables::of($transaksis)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($transaksi) {  // menambahkan kolom aksi
                //mengambil detail untuk transaksi saat ini
                // $details = DetailTransaksiModel::where('penjualan_id', $transaksi->penjualan_id)->get();

                $btn  = '<a href="' . url('/transaksi/' . $transaksi->penjualan_id) . '" class="btn btn-info btn-sm ">Detail</a> ';
                // $btn .= '<a href="' . url('/transaksi/' . $transaksi->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/transaksi/' . $transaksi->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Transaksi',
            'list' => ['Home', 'Transaksi', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Transaksi Baru'
        ];

        $barang = BarangModel::all(); //ambil data barang untuk ditampilkan di form
        $user = UserModel::all();
        $detail = DetailTransaksiModel::all();
        $activeMenu = 'transaksi'; //set menu yang sedang aktif

        return view('transaksi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'detail' => $detail, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_kode' => 'required|string|min:5|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
            'pembeli' => 'required|string|max:100',
            'barang_id' => 'required|array',
            'harga' => 'required|array',
            'jumlah' => 'required|array',
            'user_id' => 'required|integer'
        ]);

        // Simpan data penjualan
        $transaksi = TransaksiModel::create([
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'user_id' => $request->user_id,
        ]);

        // Simpan detail penjualan
        foreach ($request->barang_id as $index => $barang_id) {
            DetailTransaksiModel::create([
                'penjualan_id' => $transaksi->penjualan_id,
                'barang_id' => $barang_id,
                'harga' => $request->harga[$index],
                'jumlah' => $request->jumlah[$index],
            ]);

            // Ambil jumlah stok barang yang tersedia
            $stok = StokModel::where('barang_id', $barang_id)->first();

            // Kurangi jumlah yang dibeli dari jumlah stok yang tersedia
            $stok->stok_jumlah -= $request->jumlah[$index];

            // Simpan kembali jumlah stok yang telah diupdate
            $stok->save();
        }

        return redirect('/transaksi')->with('success', 'Data transaksi berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = TransaksiModel::with('user')->find($id);
        $detailTransaksi = DetailTransaksiModel::with('transaksi', 'barang')->whereHas('transaksi', function ($query) use ($id) {
            $query->where('penjualan_id', '=', $id);
        })->get();


        $breadcrumb = (object) [
            'title' => 'Detail Transaksi',
            'list' => ['Home', 'Transaksi', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Transaksi'
        ];

        $activeMenu = 'transaksi'; //set menu yang sedang aktif

        return view('transaksi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi' => $transaksi, 'detailTransaksi' => $detailTransaksi, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = TransaksiModel::find($id);
        if (!$check) { //mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/transaksi')->with('error', 'Data transaksi tidak ditemukan');
        }

        try {
            DetailTransaksiModel::where('penjualan_id', $id)->delete();
            $check->delete();

            return redirect('/transaksi')->with('success', 'Data transaksi berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            //jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/transaksi')->with('error', 'Data transaksi gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
