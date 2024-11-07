<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    private $pagination = 10;
    public function index()
    {
        $sales = Sale::latest()->with(['user'])->paginate($this->pagination);


        return view('sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('sale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $id = Auth::user()->id;

        $totalAmount = 0;

        $sale = Sale::create([
            'user_id' => $id,
            'total_amount' => 0,
        ]);

        $product = Product::find($request->product);
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

        return redirect()->route('sales-items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
