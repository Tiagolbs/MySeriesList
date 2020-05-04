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


Route::group(['prefix'=>'serieslist', 'where'=>['id'=>'[0-9]+']], function() {
    Route::get('',                  ['as'=>'serieslist',                'uses'=>'seriesListController@index']);
    Route::get('create',            ['as'=>'serieslist.create',         'uses'=>'seriesListController@create']);
    Route::get('{id}/destroy',      ['as'=>'serieslist.destroy',        'uses'=>'seriesListController@destroy']);
    Route::get('{id}/edit',         ['as'=>'serieslist.edit',           'uses'=>'seriesListController@edit']);
    Route::put('{id}/update',       ['as'=>'serieslist.update',         'uses'=>'seriesListController@update']);
    Route::post('store',            ['as'=>'serieslist.store',          'uses'=>'seriesListController@store']);
    Route::get('{id}/addEp',        ['as'=>'serieslist.addEp',          'uses'=>'seriesListController@addEp']);
    Route::get('{id}/removeEp',     ['as'=>'serieslist.removeEp',       'uses'=>'seriesListController@removeEp']);
    Route::get('completed',         ['as'=>'serieslist.onlyCompleted',  'uses'=>'seriesListController@onlyCompleted']);
    Route::get('watching',         ['as'=>'serieslist.onlyWatching',  'uses'=>'seriesListController@onlyWatching']);
});

Route::get('series', 'seriesController@index');
Route::get('series/create', 'seriesController@create');
Route::post('series/store', 'seriesController@store');

Route::get('movieslist', 'moviesListController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
