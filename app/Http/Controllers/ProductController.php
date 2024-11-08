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
    public function index(Request $request)
    {
        $products = Product::latest()->paginate($this->pagination);

        if ($request->ajax()) {
            return response()->json([
                'products' => $products
            ]);
        }

        return view('product.index', compact('products'));
    }


    public function create(Product $product): View
    {
        return view('product.create', compact('product'));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        }

        return redirect()->route('products.index');
    }


    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        return redirect()->route('products.index');
    }
}
