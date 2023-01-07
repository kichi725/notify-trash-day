<?php

declare(strict_types=1);

use App\Http\Controllers\LINE\LoginController;
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

Route::get('/', fn () => view('welcome'))->name('top');
Route::get('/sample', fn () => view('sample'))->middleware('guest');
// Route::get('/home', fn () => view('login'))->middleware('auth');
Route::get('login', [LoginController::class, 'credential'])->name('line.login');

Route::get('di', fn () => view('test-di'))->name('di');
Route::post('di', [\App\Http\Controllers\LINE\MessengerController::class, 'di']);
