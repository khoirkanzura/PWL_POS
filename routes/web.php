<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
// use App\Models\UserModel;






Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah', [UserController::class, 'tambah_simpan'])->name('user.tambah');
Route::get('/user/edit/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan'])->name('user.ubah');
Route::delete('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');



// *
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

// <?php

// use App\Http\Controllers\KategoriController;
// use App\Http\Controllers\LevelController;
// use App\Http\Controllers\UserController;
// use Illuminate\Support\Facades\Route;
// // use App\Models\UserModel;






// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah', [UserController::class, 'tambah_simpan'])->name('user.tambah');
// Route::get('/user/edit/{id}', [UserController::class, 'ubah']);