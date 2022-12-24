<?php

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

Route::middleware('auth')->group(function () {
	Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('thank-you', 'DashboardController@thanks')->name('thank-you');
	Route::get('contract', 'ContractController@index')->name('contract');
	Route::post('contract/save', 'ContractController@save')->name('save-contract');
	Route::resource('songs', 'SongController')->only(['create', 'store']);
	Route::resource('song-info', 'SongInfoController')->only(['create', 'store', 'update']);
	Route::resource('song-assets', 'SongAssetsController')->only('create', 'store', 'update');
	Route::get('promo-assets', 'PromoAssetsController@create')->name('promo-assets');
	Route::post('promo-assets/save', 'PromoAssetsController@save')->name('save-promo-assets');
	Route::get('social-links', 'SocialLinkController@index')->name('social-links');
	Route::post('social-links', 'SocialLinkController@save')->name('save-social-links');
});

Auth::routes();

Route::fallback(function () {
	abort(404);
});