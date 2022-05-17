<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
            $validated = $request->validate([
                'first_name' => 'required|between:2,100',
                'last_name' => 'required|between:2,100',
            ]);

            Author::create($validated);

            return redirect('admin/author')
                ->with('success', 'Author created successfully!');
        }

        return view('admin.author.create');
    }
}
