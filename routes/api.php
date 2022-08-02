<?php

use App\Http\Controllers\NvrGPSControllers;
use App\Http\Controllers\InfoControllers;
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

Route::get('/stream/info-delete', [InfoControllers::class, 'delete_info']);

Route::get('/nvr/location', [NvrGPSControllers::class, 'getLocation'])->name('getlocation');
