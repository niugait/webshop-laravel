<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('categories.list');
    }

    public function create(): View
    {
        return view('categories.form');
    }

    public function store(Request $request): View
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return view('categories.list');
    }
}
