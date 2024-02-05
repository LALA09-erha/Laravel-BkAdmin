<?php

use Google\Service\ServiceControl\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LogController;

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



// AUTH
Route::get('/login' , [AuthController::class, 'index']   );
Route::post('/prosesLogin' , [AuthController::class, 'prosesLogin']);

// logout
Route::post('/logout' , [AuthController::class, 'logout']);

// Homepage
Route::get('/', [HomeController::class, 'index']);

// Users
Route::get('/users', [UserController::class, 'index']);

// siswa
Route::get('/siswa', [SiswaController::class, 'index']);

// log perilaku
Route::get('/logperilaku', [LogController::class, 'index']);

// log tambah perilaku
Route::get('/logmanagement', [LogController::class, 'logmanagement']);
Route::post('/tambahlogsiswa', [LogController::class, 'tambahlogsiswa']);

// pelanggaran
Route::get('/pelanggaran', [LogController::class, 'pelanggaran']);
Route::post('/tambahpelanggaran', [LogController::class, 'tambahpelanggaran']);
// //delete pelanggaran
// Route::get('/deletepelanggaran/{id}', [LogController::class, 'deletepelanggaran']);
// prestasi
Route::get('/kebaikan', [LogController::class, 'kebaikan']);
Route::post('/tambahkebaikan', [LogController::class, 'tambahkebaikan']);

