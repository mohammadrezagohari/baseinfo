<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseInfoController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'base'], function () {
    Route::get('/items', [BaseInfoController::class, 'index'])->name('index');
//    Route::get('/create', [BaseInfoController::class, 'create'])->name('create');
    Route::post('/insert', [BaseInfoController::class, 'store'])->name('store');
    Route::get('/show/{id}', [BaseInfoController::class, 'show'])->name('show');
//    Route::get('/edit/{id}', [BaseInfoController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [BaseInfoController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [BaseInfoController::class, 'destroy'])->name('delete');
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
});
