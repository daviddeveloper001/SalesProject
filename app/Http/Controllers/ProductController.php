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
    private $pagination = 5;
    public function index(Request $request)
    {
        $products = Product::query()->paginate($this->pagination);
        $products->getCollection()->transform(function ($product) {
            return $product->append(['format_price', 'format_description']);
        });

        // Respuesta AJAX
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

    public function edit(Product $product): View
    {
        return view('product.edit', compact('product'));
    }

    public function update(ProductStoreRequest $request, Product $product)
    {
        $product->update($request->validated());

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
