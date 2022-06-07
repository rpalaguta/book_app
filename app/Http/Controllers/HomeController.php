<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private const CACHE_NEWEST_BOOK_LIST = 'newest_book_list_v4';
    private const CACHE_NEWEST_BOOK_TTL = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home(): View
    {

        $newestBooksList = Cache::tags(['books', 'newest_list'])->remember(
            self::CACHE_NEWEST_BOOK_LIST,
            self::CACHE_NEWEST_BOOK_TTL,
            function () {
                return Book::latest()->limit(4)->with('category')->get();
            });

        return view('app.home', [
            'newest_book' => $newestBooksList
        ]);
    }

    public function locale(string $locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
