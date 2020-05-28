<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', 'MainController@index')->name('main.index');
Route::get('history', 'HistoryController@index')->name('history.index');
Route::get('word', 'MainController@getWord')->name('main.getWord');
Route::post('word', 'MainController@postWord')->name('main.postWord');


    
