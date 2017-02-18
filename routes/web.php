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

Route::resource('/article', 'ArticleController');

Route::resource('/user', 'UserController');

Route::resource('/like', 'UserController');

Route::resource('/commentaire', 'CommentaireController');

Route::get('/home', 'HomeController@index');

