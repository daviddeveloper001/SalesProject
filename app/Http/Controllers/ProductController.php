<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $pagination = 3;
    public function index(Request $request)
    {
        $products = Product::latest()->paginate($this->pagination);

        if ($request->ajax()) {
            // Transform each product to include formatted fields
            $products = $products->getCollection()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'format_price' => $product->format_price,
                    'format_description' => $product->format_description,
                    // Incluye otros campos que necesites
                ];
            });

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
