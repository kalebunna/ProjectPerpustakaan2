<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama' => $this->faker->name(3),
            'nim' => rand(100000, 99999999),
            'kelamin' => 'laki-laki',
            'agama' => 'Islam',
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date('Y-m-d'),
            'alamat' => $this->faker->address(),
            'no_telp' => $this->faker->phoneNumber(),
            'token' => $this->faker->iosMobileToken(),
        ];
    }
}
