<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('categories.list', [
            'categories' => Category::all()
        ]);
    }

    public function create(): View
    {
        return view('categories.form');
    }

    public function edit(int $id): View
    {
        return view('categories.form', [
            'category' => Category::query()->findOrFail($id),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return redirect()->route('categories');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::query()->findOrFail($id);
        $category->fill($request->all());
        $category->save();

        return redirect()->route('categories');
    }

    public function delete(int $id): RedirectResponse
    {
        Category::destroy($id);
        return redirect()->route('categories');
    }
}
