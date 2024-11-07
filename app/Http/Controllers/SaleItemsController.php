<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\View\View;
use App\Http\Requests\StoreSaleItemRequest;
use App\Http\Requests\UpdateSaleItemRequest;

class SaleItemsController extends Controller
{
    private $pagination = 5;
    public function index(): View
    {
        $saleItems = SaleItem::with(['sale', 'product'])->latest()->paginate($this->pagination);

        return view('sale-item.index', compact('saleItems'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sale-item.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleItem $saleItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleItem $saleItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleItemRequest $request, SaleItem $saleItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleItem $saleItem)
    {
        //
    }
}
