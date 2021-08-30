<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;


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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/Users',EmployeeController::class);
Route::resource('/Accounts',AccountController::class);
Route::resource('/Options',OptionsController::class);
Route::resource('/Subs',SubController::class);
Route::resource('/Mains',MainController::class);

//Route::get('/create/{id}','SubController@create');
//Route::post('/store/{id}','SubController@store');
//Route::get('/sub/{sub}/edit/{main}','SubController@edit');
//Route::post('/update/{id}/{main}','SubController@update');
Route::post('/addOption','MainController@add');

;


