<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SchoolAndUserSeeder::class,
            AcademicYearSeeder::class,
        ]);

        if (app()->environment('local')) {
            if (! User::where('email', 'dev@example.com')->exists()) {
                User::factory()->create([
                    'name'     => 'Test Developer (Local)',
                                        'email'    => 'dev@example.com',
                                        'password' => bcrypt('password'),
                ]);
            }
        }

        $this->command->info('Database seeding completed successfully.');
    }
}
