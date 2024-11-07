<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function create(Request $request): Response
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request): Response
    {
        $product = Product::create($request->validated());

        return redirect()->route('product.index');
    }

    public function show(Request $request, Product $product): Response
    {
        return view('product.show', compact('product'));
    }

    public function destroy(Request $request, Product $product): Response
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
