<?php

use App\Http\Controllers\Auth\LineLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Line\LineMessengerController;
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
Route::get('login', fn () => view('login'))->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/sample', fn () => view('sample'))->middleware('guest');

// Route::get('/home', fn () => view('login'))->middleware('auth');

// // LINE ログイン
// Route::get('/linelogin', [LineLoginController::class, 'linelogin'])->name('linelogin');
// Route::get('/callback', [LineLoginController::class, 'callback'])->name('callback');

// // LINE メッセージ受信
// Route::post('/line/webhook', [LineMessengerController::class, 'webhook'])->name('line.webhook');
// // LINE メッセージ送信用
// Route::get('/line/message', [LineMessengerController::class, 'message']);

// Route::get('user', fn () => info('user', (array)\App\Models\User::find(1)));
