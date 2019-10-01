<?php

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
    return view('tripSearch');
})->name('home');

// Here to read the json File


Route::POST('search','SearchController@search_process')->name('search');
Route::get('search','SearchController@search_process')->name('search');
Route::get('trip_details/{trip}','SearchController@view_details')->name('trip_details');

