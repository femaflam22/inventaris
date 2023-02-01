<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin wikrama',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('adminwikrama'),
        ]);
        User::create([
            'name' => 'operator wikrama',
            'email' => 'operator@gmail.com',
            'role' => 'operator',
            'password' => Hash::make('operatorwikrama'),
        ]);
    }
}
