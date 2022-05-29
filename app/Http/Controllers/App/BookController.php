<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookCollectionResource;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    private const SORT_BY_CREATED_AT_DESC = 'created_at_desc';
    private const SORT_BY_CREATED_AT_ASC = 'created_at_asc';
    private const SORT_BY_VIEW_COUNT_ASC = 'view_count_asc';
    private const SORT_BY_VIEW_COUNT_DESC = 'view_count_desc';

    /**
     * Show the application book list
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $languages = Book::query()
            ->select('language')
            ->groupBy('language')
            ->pluck('language');

        //$languages->map(function ($element) { return $element->language; });

        return view(
            'app.book.index',
            [
                'categories' => Category::all(),
                'languages' => $languages,
                'sortingValues' => [
                    self::SORT_BY_CREATED_AT_DESC => 'Newest',
                    self::SORT_BY_CREATED_AT_ASC => 'Oldest',
                    self::SORT_BY_VIEW_COUNT_DESC => 'Most popular',
                    self::SORT_BY_VIEW_COUNT_ASC => 'Least popular',
                ]
            ]
        );
    }

    public function list(Request $request)
    {
        $books = Book::query();

        if ($request->get('name')) {
            $books->where('name', 'like', $request->get('name') . '%');
        }

        if ($request->get('language')) {
            $books->where('language', '=', $request->get('language'));
        }

        if ($request->get('category_id')) {
            $books->where('category_id', '=', $request->get('category_id'));
        }

        if ($request->get('category_name')) {
            $books->whereHas('category', function (Builder $builder) use ($request) {
                return $builder->where('name', 'like', $request->get('category_name') . '%');
            });
        }

        if ($request->get('author')) {
            $books->whereHas('authors', function (Builder $builder) use ($request) {
                return $builder->where('first_name', 'like', $request->get('author') . '%');
            });
//            $books
//                ->leftJoin('author_book', 'author_book.book_id', 'books.id')
//                ->leftJoin('authors', 'authors.id', 'author_book.author_id')
//                ->where('authors.first_name', 'like', $request->get('author') . '%');
        }

        switch ($request->get('sort_by')) {
            case self::SORT_BY_CREATED_AT_DESC:
                $books->orderByDesc('created_at');
                break;
            case self::SORT_BY_CREATED_AT_ASC:
                $books->orderBy('created_at');
                break;
            case self::SORT_BY_VIEW_COUNT_ASC:
                $books->orderBy('viewed_count', 'asc');
                break;
            case self::SORT_BY_VIEW_COUNT_DESC:
                $books->orderBy('viewed_count', 'desc');
                break;
        }


        return new BookCollection($books->paginate(10));
//        return $book->makeHidden(['sku', 'id'])->append('book_type')->toJson();
    }

    //1. Turėsim paprasta page, kuriame tiesiog bus Book title
    //2. Endpoint implementacija, skirta knygų sąrašo gavimui.
}
