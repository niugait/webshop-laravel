<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('products.list', [
            'products' => Product::all()->loadMissing('category')
        ]);
    }

    public function create(): View
    {
        return view('products.form', [
            'categories' => $this->getCategoriesList(),
        ]);
    }

    public function edit(int $id): View
    {
        return view('products.form', [
            'product' => Product::query()->findOrFail($id),
            'categories' => $this->getCategoriesList(),
        ]);
    }

    public function show(int $id): View
    {
        return view('products.show', [
            'product' => Product::query()->findOrFail($id)->loadMissing('category'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $category = new Product();
        $category->fill($request->all());
        $category->save();

        return redirect()->route('products');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::query()->findOrFail($id);
        $product->fill($request->all());
        $product->save();

        return redirect()->route('products');
    }

    public function delete(int $id): RedirectResponse
    {
        Product::destroy($id);
        return redirect()->route('products');
    }

    public function getCategoriesList(): Collection|array
    {
        return Category::all();
    }
}
