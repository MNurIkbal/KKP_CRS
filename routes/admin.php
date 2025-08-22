<?php

use App\Http\Controllers\Adm\LaporanController;
use App\Http\Controllers\Adm\PengaturanController;
use App\Http\Controllers\Adm\SaranController;
use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LaporanGabunganController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['auth']], function () {

    Route::get('dashboard', 'App\Http\Controllers\Adm\DashboardController@index')->name('dashboard');

    Route::resource('laporan', 'App\Http\Controllers\Adm\LaporanController', ['name' => 'laporan']);
    Route::get('tinjau_ulang/{id}', [LaporanController::class, 'tinjau_ulang']);
    Route::get('export_laporan',[LaporanController::class,'index']);
    Route::post('export_laporan',[LaporanController::class,'export_laporan']);
    Route::delete('hapus_logs_laporan',[LaporanController::class,'hapus_logs_laporan']);
    Route::group(['middleware' => ['admin']], function () {

        Route::resource('kekerasan', 'App\Http\Controllers\Adm\KekerasanController', ['name' => 'laporan']);

        Route::resource('identitas', 'App\Http\Controllers\Adm\IdentitasController', ['name' => 'identitas']);

        Route::resource('universitas', 'App\Http\Controllers\Adm\UniversitasController', ['name' => 'universitas']);

        Route::resource('template', 'App\Http\Controllers\Adm\TemplateController', ['name' => 'template']);

        Route::resource('user', 'App\Http\Controllers\Adm\UserController', ['name' => 'user']);

        Route::get('saran', [SaranController::class, 'index']);
        Route::delete('hapus_saran/{id}', [SaranController::class, 'destroy']);

        Route::get('pengaturan', [PengaturanController::class, 'index']);
        Route::put('update_pengaturan', [PengaturanController::class, 'update']);
    });
    Route::middleware(['middleware' => 'not_mitra'])->group(function () {
        Route::controller(LaporanGabunganController::class)->group(function () {
            Route::get('laporan_gabungan', 'index');
            Route::get('tambah_gabung_laporan', 'create');
            Route::get('detail_laporan/{id}', 'show');
            Route::get('update_tinjau_ulang/{id}', 'update_tinjau_ulang');
            Route::get('hapus_laporan_gabungan/{id}', 'destroy');
            Route::get('detail_laporan_gabungan/{id}/{kode}', 'detail_laporan_gabungan');
            Route::post('tambah_gabung_laporan', 'store');
            Route::put('pendamping_gabung', 'pendamping_gabung');
            Route::post('kirim_log', 'kirim_log');
        });
    });

    Route::post('/user/ganti-profile', [UserController::class, 'gantiProfile'])->name('user.ganti_profile');
    Route::put('/gantipassword', [UserController::class, 'gantipassword'])->name('ganti_password');

    Route::put('pendamping', [LaporanController::class, 'pendamping']);
    Route::post('chat_admin', [LaporanController::class, 'chat_admin']);

    Route::controller(LaporanController::class)->group(function () {
        Route::get('update_status_laporan/{status}/{kode_laporan}', 'update_status_laporan');
        Route::get('hapus_laporan/{kode_laporan}', 'hapus_laporan');
        Route::get('ganti_laporan/{kategori}', 'ganti_laporan');
        Route::put('update_status_laporans/', 'update_status_laporans');
    });

    Route::controller(LogController::class)->group(function() {
        Route::get('log','index');
        Route::get('hapus_log/{id}','destroy');
    });
});
