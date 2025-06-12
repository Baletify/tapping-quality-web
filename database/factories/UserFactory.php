<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $name = "$firstName $lastName";
        $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
        return [
            'name' => 'Hidayat',
            'nik' => fake()->unique()->numerify('###-###'),
            'departemen' => 'Sub Divisi B',
            'jabatan' => 'Adm A',
            'status' => 'Monthly',
            'no_hp' => fake()->numerify('08#########'),
            'role' => 'Mandor',
            'is_active' => true,
            'email' => 'adm.qm@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'), // password
            // 'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
