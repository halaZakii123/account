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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/add_account', 'AccountController@create');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add_employee', 'EmployeeController@create');
Route::post('/add', 'EmployeeController@store')->name('add');
Route::post('/add_account','AccountController@store')->name('add_account');
Route::get('/show_account/{account}','AccountController@show');
Route::get('/edit_account/{account}','AccountController@edit');
Route::post('/update_account/{account}','AccountController@update');
Route::get('/delete_account/{account}', 'AccountController@destroy');

