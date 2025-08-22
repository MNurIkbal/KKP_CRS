<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


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

// Route ke fungsi home()
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('capcha', [HomeController::class, 'captcha']);
Route::get('lupa_password', [HomeController::class, 'lupa_password']);
Route::get('kontak', [HomeController::class, 'kontak']);
Route::get('informasi', [HomeController::class, 'informasi']);

Route::get('cekstatus', [HomeController::class, 'cekstatus'])->name('cekstatus');
Route::get('cekstatus_dua', [HomeController::class, 'cekstatus_dua']);
Route::post('kirim_kontak', [HomeController::class, 'kirim_kontak']);
Route::get('reset_password/{email}', [HomeController::class, 'reset_password']);
Route::post('kirim_email', [HomeController::class, 'kirim_email']);
Route::get('kirim_chat', [HomeController::class, 'status']);
Route::post('kirim_chat', [HomeController::class, 'kirim_chat']);
Route::put('reset', [HomeController::class, 'reset']);


// Route ke fungsi form()
Route::get('/laporan/form', [HomeController::class, 'form']);
Route::post('submitlaporan', [HomeController::class, 'submitlaporan'])->name('submitlaporan');
Route::get('responselaporan', [HomeController::class, 'responselaporan'])->name('responselaporan');


// Route ke fungsi status()
Route::get('/laporan/status', [HomeController::class, 'status'])->name('status');

Route::group(['middleware' => ['login']], function () {

    // Route ke login
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login')->middleware('throttle:10,1');
});

Route::get('adm/logout', [AuthController::class, 'logout'])->name('logout');
