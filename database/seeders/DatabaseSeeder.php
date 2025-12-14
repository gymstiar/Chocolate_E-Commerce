<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================
        // SELLER ACCOUNT
        // ==========================
        User::factory()->create([
            'name' => 'Seller',
            'email' => 'penjual@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        // ==========================
        // BUYER ACCOUNT
        // ==========================
        User::factory()->create([
            'name' => 'Buyer',
            'email' => 'pembeli@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
        ]);
    }
}
