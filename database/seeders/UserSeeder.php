<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'abdo',
            'email' => 'abdo@admin.com',
            'password' => Hash::make('12345'),
            'role_id' => 1,
            'email_verified_at' => "2021-10-01 18:59:26",
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345'),
            'role_id' => 2,
            'email_verified_at' => "2021-10-01 18:59:26",
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@admin.com',
            'password' => Hash::make('12345'),
            'role_id' => 3,
            'email_verified_at' => "2021-10-01 18:59:26",
        ]);
    }
}
