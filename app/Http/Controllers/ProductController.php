<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $pagination = 10;
    public function index(Request $request): View
    {
        $products = Product::latest()->paginate($this->pagination);

        return view('product.index', compact('products'));
    }

    public function create(Product $product): View
    {
        return view('product.create', compact('product'));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect()->route('product.index');
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
