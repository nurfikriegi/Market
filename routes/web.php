<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SessionController;

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

Route::get('/', [ProdukController::class, 'index']);

Route::resource('produk', ProdukController::class)->middleware('isLogin');

Route::get('sesi', [SessionController::class, 'index'])->middleware('isAlreadyLogin');
Route::post('sesi/login', [SessionController::class, 'loginAction'])->middleware('isAlreadyLogin');
Route::get('sesi/logout', [SessionController::class, 'logoutAction']);
Route::get('sesi/registrasiform', [SessionController::class, 'registerForm'])->middleware('isAlreadyLogin');
Route::post('sesi/registation', [SessionController::class, 'registData'])->middleware('isAlreadyLogin');
