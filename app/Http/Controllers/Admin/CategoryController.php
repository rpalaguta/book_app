<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function list(): View
    {
        $categories = Category::all();

        return view('admin.category.list', compact('categories'));
    }

    public function create(Request $request): RedirectResponse|View
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|between:2,100',
                'category_id' => 'nullable',
                'active' => 'boolean'
            ]);

            Category::create($validated);

            return redirect('admin/category')
                ->with('success', 'Category created successfully!');
        }

        $firstLevelCategories = Category::where('category_id', null)->get();

        return view('admin.category.create', compact('firstLevelCategories'));
    }
}
