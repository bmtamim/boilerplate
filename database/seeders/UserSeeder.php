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
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'phone'             => '123456789',
            'password'          => Hash::make('111'),
            'status'            => true,
            'is_deletable'      => false,
            'email_verified_at' => now(),
        ]);
    }
}
