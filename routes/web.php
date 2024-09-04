<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

//Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'authlogin']);

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');



// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/halo', function () {
//     return view('halo');
// });
// Route::get('/halo', function () {
//     return view('halo');
// });

