<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@stackio.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'avatar' => null,
            'bio' => 'Stackio administrator',
            'reputation' => 9999,
        ]);
    }
}
