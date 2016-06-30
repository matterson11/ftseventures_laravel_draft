<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', 'MainPageController@home');
/*
Route::get('/dealings', function () {
    return view('dealings_page');
});
*/
Route::get('/dealings', 'DealingController@dealing');


Route::get('/about', 'PagesController@about');

//Route::get('/company', 'CompanyController@index');

Route::resource('search', 'SearchController@search');

Route::post('/searching', 'SearchController@index');

Route::get('/cards', 'CardsController@index');

Route::get('/cards/{card}', 'CardsController@show');

Route::post('/cards/{card}/notes', 'NotesController@store');

Route::get('/notes/{note}/edit', 'NotesController@edit');

Route::patch('/notes/{note}', 'NotesController@update');
