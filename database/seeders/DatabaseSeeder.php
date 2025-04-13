<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Table;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@restaurant.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // Create regular user
        User::create([
            'name' => 'User',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('123456789'),
            'is_admin' => false,
        ]);

        // Create tables
        $tables = [
            [
                'table_number' => 'T1',
                'capacity' => 4,
                'status' => 'available',
                'location' => 'main'
            ],
            [
                'table_number' => 'T2',
                'capacity' => 4,
                'status' => 'available',
                'location' => 'main'
            ]
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }

        // Run the restaurant seeder
        $this->call(RestaurantSeeder::class);
    }
}
