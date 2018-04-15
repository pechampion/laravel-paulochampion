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


Route::get('/home', 'HomeController@index');
Route::get('/new/{id}', 'FolderController@create')->name('new');
Route::get('/folder/{id}', 'FolderController@index')->name('home');
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/search/files', 'SearchController@files')->name('search.files');
Route::get('/uploadfiles/{id}', 'FilesController@index')->name('file-upload');
Route::post('/files/upload', 'FilesController@getUpload')->name('upload');
Route::get('/files/download/{hash}', 'FilesController@getDownload')->name('download');
Route::resource('/folder', 'FolderController');