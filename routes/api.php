<?php

declare(strict_types=1);

use App\Http\Controllers\LINE\{LoginController, MessengerController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/callback', [LoginController::class, 'callback']);

Route::controller(MessengerController::class)->group(function () {
    Route::post('webhook', 'webhook');
    Route::get('message', 'message');
});
