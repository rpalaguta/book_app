<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookCollectionResource;
use App\Models\Book;
use App\Models\Category;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    /**
     * Show the application book list
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        return view('app.book.index', ['categories' => Category::all()]);
    }

    public function list(Request $request)
    {
        $books = Book::query();

        if ($request->get('name')) {
            $books->where('name', 'like', $request->get('name') . '%');
        }

        if ($request->get('category_id')) {
            $books->where('category_id', '=', $request->get('category_id'));
        }

        if ($request->get('author')) {
            $books
                ->leftJoin('author_book', 'author_book.book_id', 'books.id')
                ->leftJoin('authors', 'authors.id', 'author_book.author_id')
                ->where('authors.first_name', 'like', $request->get('author') . '%');
        }

        return new BookCollection($books->paginate(10));
//        return $book->makeHidden(['sku', 'id'])->append('book_type')->toJson();
    }

    //1. Turėsim paprasta page, kuriame tiesiog bus Book title
    //2. Endpoint implementacija, skirta knygų sąrašo gavimui.
}
