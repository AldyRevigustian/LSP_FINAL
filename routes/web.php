<?php

use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (isset(Auth::user()->role)) {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/login');
});

Route::get('/home', function () {
    if (isset(Auth::user()->role)) {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/login');
});

Auth::routes();


Route::middleware('role:admin,pustakawan')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('master')->group(function () {
        Route::prefix('anggota')->controller(App\Http\Controllers\Admin\AnggotaController::class)->group(function () {
            Route::get('/', 'index')->name('admin.anggota');
            Route::post('/', 'store')->name('admin.store_anggota');
            Route::post('/{id}', 'update')->name('admin.update_anggota');
            Route::delete('/{id}', 'destroy')->name('admin.destroy_anggota');
        });

        Route::prefix('author')->controller(App\Http\Controllers\Admin\PenerbitController::class)->group(function () {
            Route::get('/', 'index')->name('admin.author');
            Route::post('/', 'store')->name('admin.store_author');
            Route::post('/{id}', 'update')->name('admin.update_author');
            Route::delete('/{id}', 'destroy')->name('admin.destroy_author');
        });

        Route::prefix('administrator')->controller(App\Http\Controllers\Admin\AdministratorController::class)->group(function () {
            Route::get('/', 'index')->name('admin.administrator');
            Route::post('/', 'store')->name('admin.store_administrator');
            Route::post('/{id}', 'update')->name('admin.update_administrator');
            Route::delete('/{id}', 'destroy')->name('admin.destroy_administrator');
        });

        Route::prefix('buku')->controller(App\Http\Controllers\Admin\BukuController::class)->group(function () {
            Route::get('/', 'index')->name('admin.buku');
            Route::post('/', 'store')->name('admin.store_buku');
            Route::post('/{id}', 'update')->name('admin.update_buku');
            Route::delete('/{id}', 'destroy')->name('admin.destroy_buku');
        });
    });

    Route::prefix('transaksi')->group(function () {
        Route::prefix('peminjaman')->controller(App\Http\Controllers\Admin\PeminjamanController::class)->group(function () {
            Route::get('/', 'index')->name('admin.peminjaman');
            Route::post('/', 'store')->name('admin.store_peminjaman');
            Route::post('/{id}', 'update')->name('admin.update_peminjaman');
            Route::delete('/{id}', 'destroy')->name('admin.destroy_peminjaman');
        });

        Route::prefix('pengembalian')->controller(App\Http\Controllers\Admin\PengembalianController::class)->group(function () {
            Route::get('/', 'index')->name('admin.pengembalian');
            Route::get('/get-denda', 'get_denda');
            Route::post('/', 'store')->name('admin.store_pengembalian');
            Route::post('/{id}', 'update')->name('admin.update_pengembalian');
            Route::delete('/{id}', 'destroy')->name('admin.destroy_pengembalian');

        });
    });

    Route::prefix('identitas')->controller(App\Http\Controllers\Admin\IdentitasController::class)->group(function () {
        Route::get('/', 'index')->name('admin.identitas');
        Route::put('/', 'update')->name('admin.update_identitas');
    });
});
