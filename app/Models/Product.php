<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal:2',
    ];

    //Relations

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    //Getters


    public function getFormatDescriptionAttribute()
    {
        $description = $this->attributes['description'];

        return $description = ucfirst(substr($description, 0, 40));
    }

    public function getFormatPriceAttribute()
    {
        $price = $this->attributes['price'];

        return $price = number_format($price, 2,);
    }

    public function getFormatNameAttribute($key)
    {
        $name = $this->attributes['name'];

        return ucwords($name);
    }
}
