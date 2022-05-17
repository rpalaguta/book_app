<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController as Admin;
use App\Http\Controllers\HomeController;
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

Route::redirect('/home', '/');

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/admin', [Admin::class, 'index']);
Route::get('/admin/book', [BookController::class, 'index']);

Route::get('/admin/category', [CategoryController::class, 'list']);
Route::get('/admin/category/create', [CategoryController::class, 'create']);
Route::post('/admin/category/create', [CategoryController::class, 'create']);

Route::get('/admin/author', [AuthorController::class, 'list']);
Route::get('/admin/author/create', [AuthorController::class, 'create'])->name('admin.author.create');
Route::post('/admin/author/create', [AuthorController::class, 'create'])->name('admin.author.create');

Route::get('/admin/book', [BookController::class, 'list']);
Route::get('/admin/book/create', [BookController::class, 'create']);
Route::post('/admin/book/create', [BookController::class, 'create']);
