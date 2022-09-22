<?php

use App\Http\Controllers\Api\DictionaryApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Api\EventApiController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);

Route::resource('events', EventController::class);
Route::get('/compare', [EventController::class, 'list'])->name('events.list');

Route::resource('countries', CountryController::class);
Route::resource('tags', TagController::class);

Route::get('/api/events', [EventApiController::class, 'index']);
Route::get('/api/categories', [DictionaryApiController::class, 'getCategories']);
Route::get('/api/countries', [DictionaryApiController::class, 'getCountries']);
