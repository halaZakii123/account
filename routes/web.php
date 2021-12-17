<?php

//use App\Http\Controllers\PollController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Task;
use App\User;


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
//

Route::get('/locale/ar', function (){

    Session::put('locale', 'ar');
    App::setLocale('ar');
    return redirect()->back();
});Route::get('/locale/en', function (){

    Session::put('locale', 'en');
    App::setLocale('en');
    return redirect()->back();
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/Users',EmployeeController::class);
Route::resource('/Accounts',AccountController::class);
Route::resource('/Options',OptionsController::class);
Route::resource('/Sets',SetController::class);
Route::resource('/Subs',SubController::class);
Route::resource('/Mains',MainController::class);
Route::resource('/Transactions',TransactionsController::class);
Route::get('/TransSearch','TransactionsController@index')->name('TransSearch');

Route::get('/printTrans/{account_number}/{from}/{to}','TransactionsController@printtransAcc')->name('printAcc');
Route::get('/printTrans/{searchType}/{source_id}','TransactionsController@printtransSou')->name('printSource');
Route::get('/printTransdate/{searchType}/{from}/{to}','TransactionsController@printtransDate')->name('printdate');

Route::get('/pdfTrans/{account_number}/{from}/{to}','TransactionsController@pdftransAcc')->name('pdfAcc');
Route::get('/pdfTrans/{searchType}/{source_id}','TransactionsController@pdftransSou')->name('pdfSource');
Route::get('/pdfTransdate/{searchType}/{from}/{to}','TransactionsController@pdftransDate')->name('pdfdate');



//use ajax to add new row in main
Route::post('/addOption','MainController@addNewRow');

//use ajax to add new row in daily operation
Route::post('/addDailyOp','MainController@addNewDaily');

//use ajax to add exchange rate
Route::post('/addC','MainController@addExchangeRate');

//use ajax to add account number
Route::post('/addA','MainController@addAccountNumber');

//use ajax to add account number for daily op
Route::post('/addADaily','MainController@addAccountNumber_Daily');

Route::get('/print','AccountController@printAccount')->name('print');
Route::get('/pdf','AccountController@pdf')->name('pdf');

Route::get('/pdfM/{id}','MainController@pdf')->name('pdfMain');
Route::get('/pdfM/daily/{id}','MainController@pdfDaily')->name('pdfDaily');
Route::get('/main/print/{id}','MainController@printM')->name('printMain');
Route::get('/main/print/daily/{id}','MainController@printMDaily')->name('printDaily');

//daily_operation route
Route::get('Accounts/daily_op_getAll','daily_operationController@getAll')->name('Accounts.daily_op');

// ?? all thies routes hav the same methode !!
Route::get('main/daily_op_create','MainController@createDailyOperation')->name('daily_op_create');
Route::get('main/dailyCashing/{cash}','MainController@createDailyOperation')->name('Mains.dailyCash');
Route::get('main/dailyCashIn/{in}','MainController@createDailyOperation')->name('Mains.dailyCashIn');
Route::get('main/dailyCashOut/{out}','MainController@createDailyOperation')->name('Mains.dailyCashOut');

//ajax datatable
Route::get('Accounts/dataTable/list','AccountController@getAccounts')->name('accounts.list');
Route::get('Employee/dataTable/list','EmployeeController@getEmployees')->name('employees.list');

Route::get('/main/search','MainController@index')->name('search');
Route::get('/AccountsTree','AccountController@createAccountTree')->name('createAccountTree');
Route::get('/BlDaily','TransactionsController@getBlDaily')->name('BLdaily');


Route::get('/pdfBL','TransactionsController@pdfBLdaily')->name('pdfBL');
Route::get('/printBL','TransactionsController@printBl')->name('printBL');

Route::get('/transSearchAccount','TransactionsController@getTransByAccount')->name('TransSearchAccount');

Route::get('/transSearch/Account/get','TransactionsController@getTransByAccount')->name('gl');

Route::get('/balanceSheet/get','TransactionsController@getBlalanceSheet')->name('BLsheetGet');

Route::get('/balanceSheet','TransactionsController@getBlalanceSheet')->name('BLsheet');

Route::get('/printSheet/{from}/{to}','TransactionsController@printsheet')->name('printSheet');

Route::get('/pdfSheet/{from}/{to}','TransactionsController@pdfBLsheet')->name('pdfSheet');

//poll
Route::resource('/poll', PollController::class);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/getvote', [App\Http\Controllers\PollController::class, 'getvote'])->name('getvote');
Route::post('/vote/{id}', [App\Http\Controllers\PollController::class, 'vote'])->name('vote');
Route::get('/result', [App\Http\Controllers\PollController::class, 'result'])->name('result');
Route::post('/add', [App\Http\Controllers\PollController::class, 'addOption'])->name('add');
Route::get('/allResult',[App\Http\Controllers\PollController::class, 'allResult'])->name('allResult');

//
//Route::get('/login/locked', 'Auth\LoginController@locked')->middleware('auth')->name('login.locked');
//Route::post('/login/locked', 'Auth\LoginController@unlock')->name('login.unlock');

///tasklist
Route::resource('tasks', TaskController::class);
Route::post('/task',[App\Http\Controllers\TaskController::class,'store_status'])->name('tasks.store_status');
Route::get('/archive',[App\Http\Controllers\TaskController::class,'archive'])->name('archive');

Route::get('/dashboard', function () {
    if(Auth::User()->parent_id == null){
        $tasks = DB::select("CALL pr_employees_tasks(".Auth::User()->id.")");//employees who have assign
    }else{ $tasks = Task::where('user_id', Auth::User()->id)->get();//all tasks that I created it
     }
    return view('dashboard',['tasks'=> $tasks]);
})->middleware(['auth'])->name('dashboard');
// ->middleware(['auth','verified'])->name('dashboard');

Route::get('/printarchive', [App\Http\Controllers\TaskController::class, 'printArchive'])->name('tasks.printArchive');
Route::get('/printcreated', [App\Http\Controllers\TaskController::class, 'printCreated'])->name('tasks.printCreated');
Route::get('/printassign', [App\Http\Controllers\TaskController::class, 'printAssign'])->name('tasks.printAssign');