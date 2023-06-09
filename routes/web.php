<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TransaksiController;
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

Route::middleware(['auth', 'role:admin'])->group(
    function () {
        Route::get('/', DashboardController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('buku', BukuController::class);
        Route::resource('member', MemberController::class);
        Route::resource('admin', AdminController::class);
        Route::get('peminjaman/pending', [PeminjamanController::class, 'pending'])->name('peminjaman.pending');
        Route::get('peminjaman/onGoing', [PeminjamanController::class, 'pinjamOnGoing'])->name('peminjaman.ongoing');
        Route::get('peminjaman/diTolak', [PeminjamanController::class, 'pinjamDiTolak'])->name('peminjaman.gettolak');
        Route::get('peminjaman/dikembalikan', [PeminjamanController::class, ''])->name('peminjaman.dikembalikan');
        Route::post('peminjaman/terima', [PeminjamanController::class, 'terima'])->name('peminjaman.terima');
        Route::post('peminjaman/tolak', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');
        Route::post('peminjaman/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('peminjaman.pengembalian');

        Route::get('identitas', [IdentitasController::class, 'index'])->name('identitas.index');
        Route::Put('identitas/{identitas}', [IdentitasController::class, 'update'])->name('identitas.update');
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
        Route::POST('transaksi/get', [TransaksiController::class, 'getDataPinjaman'])->name('transaksi.getdata');

        route::get('laporan/index', [LaporanController::class, 'index'])->name('laporan.index');
        route::post('laporan/show', [LaporanController::class, 'show'])->name('laporan.show');
    }
);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes([
    'register'  => false,
    'verify'    => false
]);
