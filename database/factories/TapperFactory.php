<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tapper>
 */
class TapperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName() . ' ' . fake()->lastName(),
            'nik' => fake()->unique()->numerify('###-###'),
            'departemen' => 'Sub Divisi B',
            'jabatan' => 'Mdr',
            'status' => fake()->randomElement(['Reguler', 'Contract FL']),
            'no_hp' => fake()->numerify('08#########'),
            'kemandoran' => 'Hendy Nur Sholeh',
            'is_active' => true,
            'user_id' => 7,
        ];
    }
}
