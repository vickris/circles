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
    return redirect()->action('Auth\LoginController@login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/circles/{circle}', 'CirclesController@show');
Route::post('/circles', 'CirclesController@store');
Route::post('/circles/{circle}/join', 'CirclesController@join');

Route::get('/loadDb', 'MoviesController@loadDb');
Route::get('/movies', 'MoviesController@index');

