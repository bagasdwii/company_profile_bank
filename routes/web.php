<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataPpobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBeritaController;
use App\Http\Controllers\DataKreditController;
use App\Http\Controllers\DataProdukController;
use App\Http\Controllers\DataSliderController;
use App\Http\Controllers\DataEdukasiController;
use App\Http\Controllers\DataProfileController;
use App\Http\Controllers\DataDepositoController;
use App\Http\Controllers\DataTabunganController;
use App\Http\Controllers\DataPenghargaanController;

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


Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/service', [HomeController::class, 'service']);
Route::get('/team', [HomeController::class, 'team']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/profile', [HomeController::class, 'profile']);

//Auth
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');;
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'authlogin']);

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/data_slider',DataSliderController::class)->middleware('auth');
Route::resource('/data_produk',DataProdukController::class)->middleware('auth');
Route::resource('/data_berita',DataBeritaController::class)->parameters(['data_berita' => 'data_berita'])->middleware('auth'); //parameter untuk penamaan nya data berita
Route::resource('/data_penghargaan',DataPenghargaanController::class)->middleware('auth');
Route::resource('/data_tabungan',DataTabunganController::class)->middleware('auth');
Route::resource('/data_profile',DataProfileController::class)->middleware('auth');
Route::resource('/data_deposito',DataDepositoController::class)->middleware('auth');
Route::resource('/data_kredit',DataKreditController::class)->middleware('auth');
Route::resource('/data_ppob',DataPpobController::class)->middleware('auth');
Route::resource('/data_edukasi',DataEdukasiController::class)->middleware('auth');






// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/halo', function () {
//     return view('halo');
// });
// Route::get('/halo', function () {
//     return view('halo');
// });

