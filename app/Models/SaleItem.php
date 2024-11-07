<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'price',
        'sale_id',
        'product_id',
        'sale_product_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal:2',
        'sale_id' => 'integer',
        'product_id' => 'integer',
        'sale_product_id' => 'integer',
    ];

    public function saleProduct(): BelongsTo
    {
        return $this->belongsTo(SaleProduct::class);
    }
}
