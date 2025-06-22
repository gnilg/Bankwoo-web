<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Kluivert kluive',
            'email' => 'kluive@bankwooa.com',
            'password'=> bcrypt('Bk2026Kluive')
        ]);
    }
}
