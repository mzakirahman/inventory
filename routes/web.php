<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanKeluarController;
use App\Http\Controllers\LaporanMasukController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\LaporanSuplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\TransaksiMasukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('/');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/data-pengguna', [PenggunaController::class, 'index'])->name('data-pengguna')->middleware(['auth', 'checkRole:1']);
Route::post('/data-pengguna/store', [PenggunaController::class, 'store'])->name('data-pengguna.store')->middleware(['auth', 'checkRole:1']);
Route::get('/data-pengguna/detail', [PenggunaController::class, 'detail'])->name('data-pengguna.detail')->middleware(['auth', 'checkRole:1']);
Route::post('/data-pengguna/update', [PenggunaController::class, 'update'])->name('data-pengguna.update')->middleware(['auth', 'checkRole:1']);
Route::post('/data-pengguna/destroy', [PenggunaController::class, 'destroy'])->name('data-pengguna.destroy')->middleware(['auth', 'checkRole:1']);

Route::get('/data-suplier', [SuplierController::class, 'index'])->name('data-suplier')->middleware(['auth', 'checkRole:1,2']);
Route::post('/data-suplier/store', [SuplierController::class, 'store'])->name('data-suplier.store')->middleware(['auth', 'checkRole:1,2']);
Route::get('/data-suplier/detail', [SuplierController::class, 'detail'])->name('data-suplier.detail')->middleware(['auth', 'checkRole:1,2']);
Route::post('/data-suplier/update', [SuplierController::class, 'update'])->name('data-suplier.update')->middleware(['auth', 'checkRole:1,2']);
Route::post('/data-suplier/destroy', [SuplierController::class, 'destroy'])->name('data-suplier.destroy')->middleware(['auth', 'checkRole:1,2']);

Route::get('/stok-barang', [StokController::class, 'index'])->name('stok-barang')->middleware(['auth', 'checkRole:1,2']);
Route::post('/stok-barang/store', [StokController::class, 'store'])->name('stok-barang.store')->middleware(['auth', 'checkRole:1,2']);
Route::get('/stok-barang/detail', [StokController::class, 'detail'])->name('stok-barang.detail')->middleware(['auth', 'checkRole:1,2']);
Route::post('/stok-barang/update', [StokController::class, 'update'])->name('stok-barang.update')->middleware(['auth', 'checkRole:1,2']);
Route::post('/stok-barang/destroy', [StokController::class, 'destroy'])->name('stok-barang.destroy')->middleware(['auth', 'checkRole:1,2']);

Route::get('/transaksi-keluar', [TransaksiKeluarController::class, 'index'])->name('transaksi-keluar')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-keluar/store', [TransaksiKeluarController::class, 'store'])->name('transaksi-keluar.store')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-keluar/update', [TransaksiKeluarController::class, 'update'])->name('transaksi-keluar.update')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-keluar/destroy', [TransaksiKeluarController::class, 'destroy'])->name('transaksi-keluar.destroy')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-keluar/store-item', [TransaksiKeluarController::class, 'store_item'])->name('transaksi-keluar.store-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::get('/transaksi-keluar/detail-item', [TransaksiKeluarController::class, 'detail_item'])->name('transaksi-keluar.detail-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-keluar/update-item', [TransaksiKeluarController::class, 'update_item'])->name('transaksi-keluar.update-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-keluar/destroy-item', [TransaksiKeluarController::class, 'destroy_item'])->name('transaksi-keluar.destroy-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::get('/transaksi-keluar/{id}', [TransaksiKeluarController::class, 'detail'])->name('transaksi-keluar.detail')->middleware(['auth', 'checkRole:1,2,3']);

Route::get('/transaksi-masuk', [TransaksiMasukController::class, 'index'])->name('transaksi-masuk')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-masuk/store', [TransaksiMasukController::class, 'store'])->name('transaksi-masuk.store')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-masuk/update', [TransaksiMasukController::class, 'update'])->name('transaksi-masuk.update')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-masuk/destroy', [TransaksiMasukController::class, 'destroy'])->name('transaksi-masuk.destroy')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-masuk/store-item', [TransaksiMasukController::class, 'store_item'])->name('transaksi-masuk.store-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::get('/transaksi-masuk/detail-item', [TransaksiMasukController::class, 'detail_item'])->name('transaksi-masuk.detail-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-masuk/update-item', [TransaksiMasukController::class, 'update_item'])->name('transaksi-masuk.update-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::post('/transaksi-masuk/destroy-item', [TransaksiMasukController::class, 'destroy_item'])->name('transaksi-masuk.destroy-item')->middleware(['auth', 'checkRole:1,2,3']);
Route::get('/transaksi-masuk/{id}', [TransaksiMasukController::class, 'detail'])->name('transaksi-masuk.detail')->middleware(['auth', 'checkRole:1,2,3']);

Route::get('/laporan-stok', [LaporanStokController::class, 'index'])->name('laporan-stok')->middleware(['auth', 'checkRole:1,4']);
Route::get('/laporan-stok/export', [LaporanStokController::class, 'export'])->name('laporan-stok.export')->middleware(['auth', 'checkRole:1,4']);
Route::get('/laporan-suplier', [LaporanSuplierController::class, 'index'])->name('laporan-suplier')->middleware(['auth', 'checkRole:1,4']);
Route::get('/laporan-suplier/export', [LaporanSuplierController::class, 'export'])->name('laporan-suplier.export')->middleware(['auth', 'checkRole:1,4']);
Route::get('/laporan-barang-masuk', [LaporanMasukController::class, 'index'])->name('laporan-barang-masuk')->middleware(['auth', 'checkRole:1,4']);
Route::get('/laporan-barang-masuk/export', [LaporanMasukController::class, 'export'])->name('laporan-barang-masuk.export')->middleware(['auth', 'checkRole:1,4']);
Route::get('/laporan-barang-keluar', [LaporanKeluarController::class, 'index'])->name('laporan-barang-keluar')->middleware(['auth', 'checkRole:1,4']);
Route::get('/laporan-barang-keluar/export', [LaporanKeluarController::class, 'export'])->name('laporan-barang-keluar.export')->middleware(['auth', 'checkRole:1,4']);
