<?php

namespace Database\Seeders;

use Database\Factories\SaleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleFactory::new()->count(10)->create();
    }
}
