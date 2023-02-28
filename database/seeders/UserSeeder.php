<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@laravel.com',
            'password' => Hash::make('q1w2e3r4t5y6'),
        ]);

        $user->assignRole('super-admin');

        // 

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@laravel.com',
            'password' => Hash::make('q1w2e3r4t5y6'),
        ]);
    }
}
