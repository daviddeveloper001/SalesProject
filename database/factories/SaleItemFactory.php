<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SaleItem;
use App\Models\SaleProduct;

class SaleItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'price' => $this->faker->randomFloat(2, 0, 99999999.99),
            'sale_id' => $this->faker->randomNumber(),
            'product_id' => $this->faker->randomNumber(),
            'sale_product_id' => SaleProduct::factory(),
        ];
    }
}
