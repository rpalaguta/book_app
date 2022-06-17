<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController as Admin;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\RoleMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\App\BookController as AppBookController;
use App\Http\Controllers\App\AuctionController;
use App\Http\Controllers\NewsController;

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

Route::get('/', [HomeController::class, 'home']);

Auth::routes();

// Route::group(['middleware' => ['auth']], function() {
    // Route::middleware([CheckRole::class . ':' . User::ROLE_ADMIN])->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::get('/', [Admin::class, 'index'])->name('admin');

            #category
            Route::prefix('/category')->group(function () {
                Route::get('/', [CategoryController::class, 'list']);
                Route::get('/show/{category}', [CategoryController::class, 'show']);
                Route::get('/create', [CategoryController::class, 'create']);
                Route::post('/create', [CategoryController::class, 'create']);
            });

            #author
            Route::prefix('/author')->group(function () {
                Route::get('/', [AuthorController::class, 'list']);
                Route::get('/show/{author}', [AuthorController::class, 'show']);
                Route::get('/create', [AuthorController::class, 'create'])->name('admin.author.create');
                Route::post('/create', [AuthorController::class, 'create'])->name('admin.author.create');
            });

            #book
            Route::prefix('/book')->group(function () {
                Route::get('/', [BookController::class, 'list'])->name('admin.book');
                Route::get('/show/{id}', [BookController::class, 'show'])->name('admin.book.show');
                Route::get('/create', [BookController::class, 'create']);
                Route::post('/create', [BookController::class, 'create']);
                Route::get('/export', [BookController::class, 'export'])->name('admin.book.export');
                Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('admin.book.delete');
                Route::get('/delete/image/{book}', [BookController::class, 'deleteImage'])->name('admin.book.delete.image');
                Route::match(['get', 'post'], '/edit/{book}', [BookController::class, 'edit'])->name('admin.book.edit');
                Route::match(['get', 'post'], '/import', [BookController::class, 'import'])->name('admin.book.import');
            });

            #users
            Route::prefix('/user')->group(function () {
                Route::get('/', [UserController::class, 'list'])->name('admin.user');
                Route::get('/blocked', [UserController::class, 'blockedList'])->name('admin.user.blocked');
                Route::match(['get', 'post'], '/create', [UserController::class, 'create'])->name('admin.user.create');
                Route::match(['get', 'post'], '/edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
                Route::post('block/{user}', [UserController::class, 'block'])->name('admin.user.block');
                Route::post('unblock/{user}', [UserController::class, 'unblock'])->name('admin.user.unblock');
            });
        });
    // });
// });

Route::get('/books', [AppBookController::class, 'index'])->name('app.books');
Route::get('/books/import', [AppBookController::class, 'import'])->name('app.books.import');
Route::get('/auctions', [AuctionController::class, 'create'])->name('app.auctions');
Route::get('/books-list', [AppBookController::class, 'list'])->name('app.books-list');

#admin/books - list
#get admin/books/{book} -> view
#delete admin/books/{book}
#post admin/books/{book} -> naujo sukurimas
#put admin/books/{book} -> update
#put admin/books/export -> update
#put admin/books/import -> update

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('locale/{locale}', [HomeController::class, 'locale'])->name('locale');


#Savarankiška užduotis

Route::prefix('/news')->group(function () {
    Route::get('/', [NewsController::class, 'list'])->name('news.home');
    Route::match(['get', 'post'], '/create', [NewsController::class, 'create'])->name('news.create');
    Route::match(['get', 'post'], '/edit/{article}', [NewsController::class, 'edit'])->name('news.edit');
    // Route::get('/show/{id}', [NewsController::class, 'show'])->name('news.show');

    // Route::delete('/delete/{article}', [BookController::class, 'destroy'])->name('news.delete');
});
