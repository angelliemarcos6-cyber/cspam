<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalDatabaseResetSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('local')) {
            $this->command->warn('This reset seeder is only allowed in local environment.');
            return;
        }

        $this->command->warn('⚠️  TRUNCATING CORE TABLES IN LOCAL ENVIRONMENT  ⚠️');

        DB::statement('TRUNCATE TABLE
            users, schools,
            model_has_permissions, model_has_roles, role_has_permissions,
            roles, permissions
            CASCADE;');

        // Reset sequences so IDs start from 1 again (PostgreSQL)
        DB::statement('ALTER SEQUENCE users_id_seq RESTART WITH 1;');
        DB::statement('ALTER SEQUENCE schools_id_seq RESTART WITH 1;');
        DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;');
        // add others if needed (permissions_id_seq etc.)

        $this->command->info('Core tables truncated and sequences reset.');
    }
}
