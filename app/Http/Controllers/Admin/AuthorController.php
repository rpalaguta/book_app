<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function list(): View
    {
        $authors = Author::all();

        return view('admin.author.list', compact('authors'));
    }

    public function create(Request $request): RedirectResponse|View
    {
        if ($request->isMethod('post')) {
             $request->validate([
                'first_name' => 'required|between:2,100',
                'last_name' => 'required|between:2,100',
            ]);

            Author::create($request->all());

            return redirect('admin/author')
                ->with('success', 'Author created successfully!');
        }

        return view('admin.author.create');
    }

    public function show(Author $author): View
    {
        return view('admin.author.show', compact('author'));
    }
}
