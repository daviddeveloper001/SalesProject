<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\View\View;
use App\Http\Requests\StoreSaleItemRequest;
use App\Http\Requests\UpdateSaleItemRequest;
use Illuminate\Http\Request;

class SaleItemsController extends Controller
{
    private $pagination = 5;
    public function index(Request $request)
    {

        $saleItems = SaleItem::query()->latest()
            ->with(['sale', 'product'])
            ->paginate($this->pagination);

        $saleItems->getCollection()->transform(function ($saleItem) {
            $saleItem->append('formatted_created');
            if ($saleItem->product) {
                $saleItem->product->append(['format_price', 'format_description', 'format_name']);
            }
            return $saleItem;
        });

        if ($request->ajax()) {
            return response()->json([
                'saleItems' => $saleItems
            ]);
        }

        return view('sale-item.index', compact('saleItems'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sale-item.create', compact('products'));
    }

    public function store(StoreSaleItemRequest $request)
    {
        //
    }


    public function destroy(Request $request, SaleItem $saleItem)
    {
        $saleItem->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        return redirect()->route('sales-items.index');
    }
}
