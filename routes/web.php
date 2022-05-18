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

Route::get('/admin', [Admin::class, 'index'])->name('admin');
Route::get('/admin/book', [BookController::class, 'index']);

Route::get('/admin/category', [CategoryController::class, 'list']);
Route::get('/admin/category/show/{category}', [CategoryController::class, 'show']);
Route::get('/admin/category/create', [CategoryController::class, 'create']);
Route::post('/admin/category/create', [CategoryController::class, 'create']);

Route::get('/admin/author', [AuthorController::class, 'list']);
Route::get('/admin/author/show/{author}', [AuthorController::class, 'show']);
Route::get('/admin/author/create', [AuthorController::class, 'create'])->name('admin.author.create');
Route::post('/admin/author/create', [AuthorController::class, 'create'])->name('admin.author.create');

Route::get('/admin/book', [BookController::class, 'list'])->name('admin.book');
Route::get('/admin/book/show/{book}', [BookController::class, 'show'])->name('admin.book.show');
Route::get('/admin/book/create', [BookController::class, 'create']);
Route::post('/admin/book/create', [BookController::class, 'create']);
Route::get('/admin/book/export', [BookController::class, 'export'])->name('admin.book.export');
Route::match(['get', 'post'],'/admin/book/edit/{book}', [BookController::class, 'edit'])->name('admin.book.edit');
Route::match(['get', 'post'], '/admin/book/import', [BookController::class, 'import'])->name('admin.book.import');

#admin/books - list
#get admin/books/{book} -> view
#delete admin/books/{book}
#post admin/books/{book} -> naujo sukurimas
#put admin/books/{book} -> update
#put admin/books/export -> update
#put admin/books/import -> update
