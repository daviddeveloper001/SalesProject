<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
        ])->assignRole('admin');

        User::create([
            'name' => 'vendedor',
            'email' => 'vendedor@test.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),

        ])->assignRole('vendedor');


        User::create([
            'name' => 'auxiliar de bodega',
            'email' => 'auxiliar@test.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
        ])->assignRole('auxiliar de bodega');
    }
}
