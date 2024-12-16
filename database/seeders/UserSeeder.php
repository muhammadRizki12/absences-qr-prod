<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Seeder;
// use Database\Factories\UserFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserModel::create([
            'nip' => '12345',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'gender' => 'laki-laki',
            'job_tier' => 'top tier',
            'main_position' => 'admin',
            'role' => 'admin',
        ]);

        UserModel::factory()->count(5)->create(); // Membuat 10 data dummy
    }
}
