<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

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
            $validated = $request->validate([
                'name' => 'required|between:2,255',
                'category_id' => 'required',
            ]);

            Book::create($validated);

            return redirect('admin/book')
                ->with('success', 'Book created successfully!');
        }

        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get()
        ;

        return view('admin.book.create', compact('categories'));
    }
}
