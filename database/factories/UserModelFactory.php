<?php

namespace Database\Factories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition()
    {
        return [
            'nip' => $this->faker->unique()->numerify('##########'),
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('123456'), // Default password
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'rank' => $this->faker->word,
            'grade' => $this->faker->word,
            'job_tier' => $this->faker->word,
            'main_position' => $this->faker->jobTitle,
            'additional_position' => $this->faker->optional()->jobTitle,
            'role' => 'guru',
        ];
    }
}
