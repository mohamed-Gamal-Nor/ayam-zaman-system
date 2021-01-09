<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes(['register'=> false]);
Route::get('/locked','App\Http\Controllers\ChatterLock@lock')->name('locked');
Route::post('/unlocked','App\Http\Controllers\ChatterLock@unlock')->name('unlock');

Route::group(['middleware' => ['auth','lock_screen']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('invoices', 'App\Http\Controllers\InvoicesController');
    Route::resource('sections', 'App\Http\Controllers\SectionsController');
    Route::resource('products', 'App\Http\Controllers\ProductsController');
    Route::resource('roles','App\Http\Controllers\RoleController');
    Route::get('users/active','App\Http\Controllers\UserController@activeUsers');
    Route::get('users/notactive','App\Http\Controllers\UserController@activeNotUsers');
    Route::get('users/userdisable/{id}','App\Http\Controllers\UserController@userdisable');
    Route::get('users/userActive/{id}','App\Http\Controllers\UserController@userActive');
    Route::resource('users','App\Http\Controllers\UserController');
    Route::resource('sectionUsers','App\Http\Controllers\SectionUSersController');
    Route::resource('storesMaterials','App\Http\Controllers\StoresController');
    Route::resource('storesGoods','App\Http\Controllers\GoodsStoreController');
    Route::get('suppliers/active','App\Http\Controllers\SuppliersController@activeSupplier');
    Route::get('suppliers/notactive','App\Http\Controllers\SuppliersController@supplierDisable');
    Route::get('suppliers/suppliersDisable/{id}','App\Http\Controllers\SuppliersController@disableSupplier');
    Route::get('suppliers/suppliersActive/{id}','App\Http\Controllers\SuppliersController@supplierActive');
    Route::resource('suppliers','App\Http\Controllers\SuppliersController');
    //customers route
    Route::get('customers/softDelete', 'App\Http\Controllers\CustomersController@softDelete')->name('softDelete');
    Route::get('customers/backSoftDelete/{id}', 'App\Http\Controllers\CustomersController@backSoftDelete')->name('backsoftDelete');
    Route::get('customers/trashedCustomers', 'App\Http\Controllers\CustomersController@trashedCustomers');
    Route::get('customers/export', 'App\Http\Controllers\CustomersController@export');
    Route::resource('customers','App\Http\Controllers\CustomersController');
    //end customer route
    //employees route
    Route::get('employees/active','App\Http\Controllers\EmployeesController@activeEmployee');
    Route::get('employees/notactive','App\Http\Controllers\EmployeesController@employeeDisable');
    Route::get('employees/disableEmployee/{id}','App\Http\Controllers\EmployeesController@disableEmployee');
    Route::get('employees/employeeActive/{id}','App\Http\Controllers\EmployeesController@employeeActive');
    Route::get('employees/export', 'App\Http\Controllers\EmployeesController@export');
    Route::get('employees/softDelete', 'App\Http\Controllers\EmployeesController@softDelete')->name('softDelete');
    Route::get('employees/backSoftDelete/{id}', 'App\Http\Controllers\EmployeesController@backSoftDelete')->name('backsoftDelete');
    Route::get('employees/trashEmployees', 'App\Http\Controllers\EmployeesController@trashedEmployees');
    Route::resource('employees','App\Http\Controllers\EmployeesController');
    //end employees route
    Route::get('advancePayment/search', 'App\Http\Controllers\AdvancePaymentController@search');
    Route::resource('advancePayment','App\Http\Controllers\AdvancePaymentController');
});
Route::resource('materials','App\Http\Controllers\MaterialsController');
Route::resource('ClosingSalary','App\Http\Controllers\ClosingSalaryController');

Route::get('/{page}', 'App\Http\Controllers\AdminController@index');