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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/discover', 'HomeController@discover')->name('home');

Route::post('/booklist', 'BooklistsController@create')->name('create-list');
Route::get('/booklist/{id}', 'BooklistsController@index')->name('get-list');

Route::post('/book', 'BooksController@create')->name('create-book');
Route::get('/book/{id}', 'BooksController@show')->name('show-book');


Route::get('/profile/{id}', 'HomeController@profile')->name('user-profile');
