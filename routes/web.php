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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'uses' => 'UserController@checkLoggedIn',
        'as' => 'home'
    ]);
    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',
        'as' => 'signup'
    ]);
    Route::get('/dashboard', [
        'uses' => 'PostController@getDashboard',
        'as' => 'dashboard',
        'middleware' => 'auth'
    ]);
    Route::post('/login', [
        'uses' => 'UserController@postSignIn',
        'as' => 'login'
    ]);
    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
    ]);
});
