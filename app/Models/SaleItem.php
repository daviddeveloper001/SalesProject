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
    ];

    //Relations
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    //Getters

    public function getFormatPriceAttribute()
    {
        $price = $this->attributes['price'];
        return number_format($price, 2, ',', '.');
    }

    public function getFormattedCreatedAttribute($key)
    {
        $created = $this->attributes['created_at'];
        return date('d-m-Y', strtotime($created));
    }
}
