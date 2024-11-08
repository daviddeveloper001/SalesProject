<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $pagination = 10;
    public function index(Request $request)
    {

        $sales = Sale::latest()->with(['user', 'items.product'])->paginate($this->pagination);

        if ($request->ajax()) {
            return response()->json([
                'saleItems' => $sales
            ]);
        }

        return view('sale.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();

        return view('sale.create', compact('products'));
    }


    public function store(StoreSaleRequest $request)
    {
        $id = Auth::user()->id;
        $totalAmount = 0;


        $sale = Sale::create([
            'user_id' => $id,
            'total_amount' => 0,
        ]);

        $product = Product::find($request->idProduct);
        $quantity = $request->quantity;

        $productPrice = $product->price;
        $totalPrice = $quantity * $productPrice;


        SaleItem::create([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $productPrice,
        ]);

        $totalAmount = $totalPrice;

        $sale->total_amount = $totalAmount;
        $sale->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'saleItem' => [
                    'id' => $sale->id,
                    'product_name' => $product->name,
                    'price' => $productPrice,
                    'quantity' => $quantity,
                    'created_at' => $sale->created_at,
                ],
            ]);
        }

        return redirect()->route('sales-items.index');
    }

    public function destroy(Request $request, Sale $sale)
    {
        $sale->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        return redirect()->route('sales.index');
    }
}
