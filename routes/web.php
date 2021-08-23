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

Route::get('/create/{id}','SubController@create');
Route::post('/store/{id}','SubController@store');
Route::get('/sub/{sub}/edit/{main}','SubController@edit');
Route::post('/update/{id}/{main}','SubController@update');


//Route::get('/add_employee', 'EmployeeController@create');
//Route::post('/add', 'EmployeeController@store')->name('add');
//Route::post('/add_account','AccountController@store')->name('add_account');
//Route::get('/show_account/{account}','AccountController@show');
//Route::get('/edit_account/{account}','AccountController@edit');
//Route::patch('/update_account/{account}','AccountController@update');
//Route::get('/delete_account/{account}', 'AccountController@destroy');
//Route::get('/show_master/{master_account_number}', 'AccountController@show1');
//
////Route for Option table
//Route::get('/getAll','OptionsController@index');
//Route::get('/createOption','OptionsController@create');
//Route::post('/store','OptionsController@store')->name('add_option');
//Route::patch('/update/{option}','OptionsController@update');
//Route::get('/edit/{option}','OptionsController@edit');
//
//Route::DELETE('/delete/{option}','OptionsController@destroy');


