<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Add any other seeders here in the future (in correct order)
            SchoolAndUserSeeder::class,
            // ExampleStudentSeeder::class,          // ← add later when you create it
            // ExampleAcademicYearSeeder::class,     // ← add later
        ]);

        // Optional: Keep a fallback test user if you want quick login for development
        // You can comment this out once your real users are seeded
        \App\Models\User::factory()->create([
            'name'  => 'Test Developer',
            'email' => 'dev@example.com',
            'password' => bcrypt('password'), // or Hash::make('password')
        ]);
    }
}
