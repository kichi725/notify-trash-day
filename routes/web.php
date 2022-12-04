<?php

use App\Http\Controllers\Auth\LineLoginController;
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

Route::get('/', fn () => view('welcome'));
Route::get('/sample', fn () => view('sample'));

Route::get('/login', fn () => view('login'));

// 2行追加
Route::get('/linelogin', [LineLoginController::class, 'linelogin'])->name('linelogin');
Route::get('/callback', [LineLoginController::class, 'callback'])->name('callback');
