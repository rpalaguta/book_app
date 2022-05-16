<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::all();

        return view('admin.book.list', compact('books'));
    }
}
