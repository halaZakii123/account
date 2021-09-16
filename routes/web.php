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
    return view('home');
});
//Route::get('locale/ar', function ($locale){
//    if (! in_array($locale, ['en', 'ar'])) {
//        abort(400);
//    }
//    Session::put('locale', $locale);
//    App::setLocale($locale);
//    return redirect()->back();
//});
Route::get('/locale/ar', function (){

    Session::put('locale', 'ar');
    App::setLocale('ar');
    return redirect()->back();
});Route::get('/locale/en', function (){

    Session::put('locale', 'en');
    App::setLocale('en');
    return redirect()->back();
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
Route::post('/addC','MainController@addE');

Route::get('/print','AccountController@printAccount');
Route::get('/pdf','AccountController@pdf');

Route::get('/pdfM/{id}','MainController@pdf');
Route::get('/main/print/{id}','MainController@printM');

Route::get('Accounts/list', [AccountController::class, 'getAccounts'])->name('accounts.list');



