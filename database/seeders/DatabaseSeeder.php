<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'is_active' => 1,
        ]);

        // Retailer User
        User::create([
            'name' => 'Retailer User',
            'email' => 'retailer@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
            'is_active' => 1,
        ]);

    }

}
