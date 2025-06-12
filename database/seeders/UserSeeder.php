<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create();
        // User::factory()->create(
        //     [
        //         'name' => 'Test User',
        //         'email' => 'test@example.org',
        //         'nik' => '112-134',
        //         'departemen' => 'QA/QM',
        //         'jabatan' => 'Inst',
        //         'no_hp' => '08123456789',
        //         'role' => 'Instruktur',
        //         'is_active' => true,
        //         'password' => bcrypt('password'), // password
        //         'email_verified_at' => now(),
        //         'remember_token' => null,
        //     ]
        // );
    }
}
