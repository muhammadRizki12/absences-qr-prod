<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserModel::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang aman
            'role' => 'admin', // Pastikan ini sesuai dengan enum role Anda
        ]);
    }
}
