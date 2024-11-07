<?php

namespace Database\Seeders;


use Database\Factories\SaleItemFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleItemFactory::new()->count(10)->create();
    }
}
