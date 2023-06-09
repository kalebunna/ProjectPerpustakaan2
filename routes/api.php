<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BukuController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\PeminjamanController;
use App\Http\Controllers\API\PengembalianController;
use App\Http\Controllers\API\Qrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('kategori', [KategoriController::class, "index"]);
Route::post('kategori/store', [KategoriController::class, "store"]);
Route::get('kategori/{id}/show', [KategoriController::class, "show"]);

// Route::post('Login/login_mahasiswa', [AuthController::class]);

Route::post('Login/login_mahasiswa', AuthController::class);
Route::get('Buku/buku_filter', [BukuController::class, 'filterBuku']);
Route::get('Buku/buku_detail/{id}', [BukuController::class, 'getDataById']);
Route::get('Peminjaman/{id}', [PeminjamanController::class, 'getPeminjamanByUser']);
Route::get('Peminjaman/detail/{id}', [PeminjamanController::class, 'show']);
Route::post('Peminjaman/peminjaman', [PeminjamanController::class, 'store']);
Route::post('pengembalian/pengembalian', [PengembalianController::class, 'store']);
Route::get('Pengembalian/{id}', [PengembalianController::class, 'show']);

Route::post('qrcode', Qrcode::class);
// Route::get('gettes', [BukuController::class, 'get_data_peminjaman_with_buku']);
