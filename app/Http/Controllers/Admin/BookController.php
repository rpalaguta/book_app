<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function list(): View
    {
        $books = Book::all();

        return view('admin.book.list', compact('books'));
    }

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
             $request->validate([
                'name' => 'required|between:2,255',
                'category_id' => 'required',
            ]);

            $book = Book::create($request->all());

            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

            return redirect('admin/book')
                ->with('success', 'Book created successfully!');
        }

        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get()
        ;

        $authors = Author::all();

        return view('admin.book.create', compact('categories', 'authors'));
    }

    public function show(Book $book): View
    {
        return view('admin.book.show', compact('book'));
    }
}
