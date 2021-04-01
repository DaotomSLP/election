<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ExpenditureController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportProductsController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\SuccessController;
use App\Models\User;

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


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::post('/selectSubject', [HomeController::class, 'selectSubject'])->middleware('auth')->name('selectSubject');

Route::post('/election', [HomeController::class, 'election'])->middleware('auth')->name('election');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/dashboard/{id}', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/subjects', [HomeController::class, 'subjects'])->middleware('auth')->name('subjects');

Route::post('/addSubject', [HomeController::class, 'addSubject'])->middleware('auth')->name('addSubject');

Route::get('/editSubject/{id}', [HomeController::class, 'editSubject'])->middleware('auth')->name('editSubject');

Route::post('/updateSubject', [HomeController::class, 'updateSubject'])->middleware('auth')->name('updateSubject');

Route::get('/closeSubject/{id}', [HomeController::class, 'closeSubject'])->middleware('auth')->name('closeSubject');

Route::get('/enableSubject/{id}', [HomeController::class, 'enableSubject'])->middleware('auth')->name('enableSubject');

Route::get('/users', [UsersController::class, 'index'])->middleware('auth')->name('users');

Route::post('/addUser', [UsersController::class, 'insert'])->middleware('auth')->name('addUser');

Route::get('/editUser/{id}', [UsersController::class, 'edit'])->middleware('auth')->name('editUser');

Route::post('/updateUser', [UsersController::class, 'update'])->middleware('auth')->name('updateUser');

Route::get('/deleteUser/{id}', [UsersController::class, 'delete'])->middleware('auth')->name('deleteUser');

Route::get('/openUser/{id}', [UsersController::class, 'open'])->middleware('auth')->name('openUser');

Auth::routes();
