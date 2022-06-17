<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function list(): View
    {
        $news = News::all();

        //$books = Book::withTrashed()->with('category')->get();

        return view('news.index', [
            'news' => $news,
            // 'count' => 30,
        ]);
    }

    /**
     * @param News $news
     * @return RedirectResponse
     */

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|between:2,100',
                'active' => 'required',
            ]);

            News::create($request->all());

        

            return redirect(route('news.home'))
                ->with('success', 'Article created successfully!');
        }

        

        return view('news.create');
    }

    public function edit(News $article, Request $request): View|RedirectResponse
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|between:2,100',
                'active' => 'required',
            ]);

            $article->update($request->all());

            return redirect(route('news.home', $article->id))
                ->with('success', 'Article edited successfully!');
        }

        // return view('news.edit', ['article' => $article]);
        return view('news.edit', compact('article'));
    }

    public function delete(News $news): RedirectResponse
    {
        $news->delete();

        return redirect(route('news.home'))->with('success', 'Article deleted successfully!');
    }
}
