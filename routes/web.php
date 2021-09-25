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
Route::resource('/Sets',SetController::class);
Route::resource('/Subs',SubController::class);
Route::resource('/Mains',MainController::class);

//Route::get('/create/{id}','SubController@create');
//Route::post('/store/{id}','SubController@store');
//Route::get('/sub/{sub}/edit/{main}','SubController@edit');
//Route::post('/update/{id}/{main}','SubController@update');
Route::post('/addOption','MainController@add');
Route::post('/addDailyOp','MainController@addDaily');
Route::post('/addC','MainController@addE');
Route::post('/addA','MainController@addA');
Route::post('/addADaily','MainController@addADaily');

Route::get('/print','AccountController@printAccount')->name('print');
Route::get('/pdf','AccountController@pdf')->name('pdf');

Route::get('/pdfM/{id}','MainController@pdf');
Route::get('/pdfM/daily/{id}','MainController@pdfDaily');
Route::get('/main/print/{id}','MainController@printM');
Route::get('/main/print/daily/{id}','MainController@printMDaily');

//daily_operation route
Route::get('Accounts/daily_op_getAll','daily_operationController@getAll')->name('Accounts.daily_op');
Route::get('main/daily_op_create','MainController@createDaily')->name('daily_op_create');
Route::get('main/dailyCashing/{cash}','MainController@createDaily')->name('Mains.dailyCash');
Route::get('main/dailyCashIn/{in}','MainController@createDaily')->name('Mains.dailyCashIn');
Route::get('main/dailyCashOut/{out}','MainController@createDaily')->name('Mains.dailyCashOut');

//ajax datatable
Route::get('Accounts/dataTable/list','AccountController@getAccounts')->name('accounts.list');
Route::get('Employee/dataTable/list','EmployeeController@getEmployees')->name('employees.list');

Route::post('main/search','MainController@index')->name('search');
