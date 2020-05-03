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

Route::get('/', function () {
    return view('welcome');
});

Route::get('serieslist', 'seriesListController@index');
Route::get('serieslist/create', 'seriesListController@create');
Route::post('serieslist/store', 'seriesListController@store');
Route::get('serieslist/{id}/destroy', 'seriesListController@destroy');
Route::get('serieslist/{id}/edit', 'seriesListController@edit');
Route::put('serieslist/{id}/update', 'seriesListController@update');

Route::get('series', 'seriesController@index');
Route::get('series/create', 'seriesController@create');
Route::post('series/store', 'seriesController@store');

Route::get('movieslist', 'moviesListController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
