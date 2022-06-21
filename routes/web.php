<?php

use App\Http\Controllers\AppControllers;
use App\Http\Controllers\CompanyControllers;
use App\Http\Controllers\DashboardControllers;
use App\Http\Controllers\EbookControllers;
use App\Http\Controllers\EmbeddControllers;
use App\Http\Controllers\FileControllers;
use App\Http\Controllers\FlashMsgControllers;
use App\Http\Controllers\GameControllers;
use App\Http\Controllers\InfoControllers;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MovieControllers;
use App\Http\Controllers\MusicControllers;
use App\Http\Controllers\NewsControllers;
use App\Http\Controllers\NvrGPSControllers;
use App\Http\Controllers\PhotoControllers;
use App\Http\Controllers\RouteControllers;
use App\Http\Controllers\SettingControllers;
use App\Http\Controllers\SliderControllers;
use App\Http\Controllers\StreamScreenControllers;
use App\Http\Controllers\TVContollers;
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



Route::prefix('/app')->group(function () {
    Route::get('/', [AppControllers::class, 'index']);
    Route::get('/info-loading', [AppControllers::class, 'infoLoading'])->name('loading-infoLoading');
    Route::get('/carousel-loading', [AppControllers::class, 'carouselLoading'])->name('loading-carouselLoading');
    Route::get('/movie', [AppControllers::class, 'movie'])->name('app-movie');
    Route::get('/movie-loading', [AppControllers::class, 'movie_loading'])->name('loading-movie');
    Route::get('/play/movie/{id}', [AppControllers::class, 'playMovie'])->name('app-play-movie');
    Route::get('/play/tv/{id}', [AppControllers::class, 'playTv'])->name('app-play-tv');
    Route::get('/music', [AppControllers::class, 'music']);
    Route::get('/seputar-kai/{id}', [AppControllers::class, 'company'])->name('app-company');
    Route::get('/cctv', [AppControllers::class, 'cctv'])->name('app-cctv');
    Route::get('/game', [AppControllers::class, 'game'])->name('app-game');
    Route::get('/game-loading', [AppControllers::class, 'game_loading'])->name('loading-game');
    Route::get('/news/{id}', [AppControllers::class, 'news'])->name('app-news');
    Route::get('/nvr/cctv', [NvrGPSControllers::class, 'tes'])->name('play-cctv');
    Route::get('/ebooks', [AppControllers::class, 'ebook'])->name('app-ebooks');
    Route::get('/ebooks-loading', [AppControllers::class, 'ebook_loading'])->name('loading-ebooks');
    Route::get('/ebooks/{id}', [AppControllers::class, 'readEbook'])->name('app-ebooks-read');
    Route::get('/galeri', [AppControllers::class, 'galeri'])->name('app-galeri');
    Route::get('/galeri-loading', [AppControllers::class, 'galeri_loading'])->name('loading-galeri');
});
Route::prefix('/file')->group(function () {
    Route::get('/movie/{path}', [FileControllers::class, 'fileMovie'])->name('file-show-movie');
    Route::get('/music/{path}', [FileControllers::class, 'fileMusic'])->name('file-show-music');
    Route::get('/ebook/{path}', [FileControllers::class, 'fileEbook'])->name('file-show-ebook');
    Route::get('/game/{path}', [FileControllers::class, 'fileGame'])->name('file-show-game');
    Route::get('/news/{path}', [FileControllers::class, 'fileNews'])->name('file-show-news');
    Route::get('/photo/{path}', [FileControllers::class, 'filePhoto'])->name('file-show-photo');
    Route::get('/tv/{path}', [FileControllers::class, 'fileChTv'])->name('file-show-tv');
    Route::get('/company/{path}', [FileControllers::class, 'fileCompany'])->name('file-show-company');
    Route::get('/slider/{path}', [FileControllers::class, 'fileSlider'])->name('file-show-slider');
});
Route::get('/', [DashboardControllers::class, 'index'])->name('dashboard');
Route::get('/embded/{id}', [EmbeddControllers::class, 'show'])->name('file-embded');
Route::prefix('/stream')->group(function () {
    Route::get('/cctv', [StreamScreenControllers::class, 'cctv'])->name('stream-cctv');
    Route::get('/location', [StreamScreenControllers::class, 'location'])->name('stream-location');
    Route::get('/info', [StreamScreenControllers::class, 'info'])->name('stream-info');
    Route::post('/info/create', [InfoControllers::class, 'createInfo'])->name('create-info');
    Route::get('/info/get-info', [InfoControllers::class, 'getInfo'])->name('get-info');
});

// ADMIN PAGE
Route::resource('/movie', MovieControllers::class);
Route::resource('/music', MusicControllers::class);
Route::resource('/ebook', EbookControllers::class);
Route::resource('/game', GameControllers::class);
Route::resource('/photo', PhotoControllers::class);
Route::resource('/news', NewsControllers::class);
Route::resource('/tv', TVContollers::class);
Route::resource('/location', LocationController::class);
Route::resource('/setting', SettingControllers::class);
Route::resource('/route', RouteControllers::class);
Route::resource('/company', CompanyControllers::class);
Route::resource('/slider', SliderControllers::class);

Route::get('/flash-succes/{param}', [FlashMsgControllers::class, 'index'])->name('flashMsg');
