<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/blank', [HomeController::class, 'blank']);

Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [ProductsController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductsController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductsController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductsController::class, 'babyKid']);
});

Route::get('/user/{id}/name/{name}', [UserController::class, 'userProfile']);

Route::get('/transaction', [TransactionController::class, 'transaction']);

// js 3
Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);

// Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/{kategori}/update', [KategoriController::class, 'update'])->name('kategori.update');

// Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/m_user1', [UserController::class, 'create']);
Route::post('/m_user1', [UserController::class, 'store']);

Route::get('/m_level', [LevelController::class, 'create']);
Route::post('/m_level', [LevelController::class, 'store']);


Route::resource('m_user', POSController::class);

// js7
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); //Menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); //Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); //Menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); //Menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']); //Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); //Menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); //Menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); //Menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); //Menampilkan halaman awal user
    Route::post('/list', [LevelController::class, 'list']); //Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']); //Menampilkan halaman form tambah user
    Route::post('/', [LevelController::class, 'store']); //Menyimpan data user baru
    Route::get('/{id}', [LevelController::class, 'show']); //Menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']); //Menampilkan halaman form edit user
    Route::put('/{id}', [LevelController::class, 'update']); //Menyimpan perubahan data user
    Route::delete('/{id}', [LevelController::class, 'destroy']); //Menghapus data user
});

// Route::group(['prefix' => 'kategori'], function(){
//     Route::get('/', [KategoriController::class, 'index']); //Menampilkan halaman awal user
//     Route::post('/list', [KategoriController::class, 'list']); //Menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [KategoriController::class, 'create']); //Menampilkan halaman form tambah user
//     Route::post('/', [KategoriController::class, 'store']); //Menyimpan data user baru
//     Route::get('/{id}', [KategoriController::class, 'show']); //Menampilkan detail user
//     Route::get('/{id}/edit', [KategoriController::class, 'edit']); //Menampilkan halaman form edit user
//     Route::put('/{id}', [KategoriController::class, 'update']); //Menyimpan perubahan data user
//     Route::delete('/{id}', [KategoriController::class, 'destroy']); //Menghapus data user
// });

Route::resource('kategori', KategoriController::class);

Route::resource('barang', BarangController::class);
Route::post('barang/list', [BarangController::class, 'list']);

Route::resource('stok', StokController::class);
Route::post('stok/list', [StokController::class, 'list']);

Route::resource('transaksi', TransaksiController::class);
Route::post('transaksi/list', [TransaksiController::class, 'list']);

// Route::get('/detailTransaksi', [TransaksiController::class, 'list']);
