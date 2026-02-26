<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevelopmentResetSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('local')) {
            $this->command->error('This seeder can only run in local environment!');
            return;
        }

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        \Illuminate\Support\Facades\DB::table('activity_log')->truncate();
        \Illuminate\Support\Facades\DB::table('students')->truncate();
        \Illuminate\Support\Facades\DB::table('sections')->truncate();
        \Illuminate\Support\Facades\DB::table('school_yearly_data')->truncate();
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \Illuminate\Support\Facades\DB::table('schools')->truncate();

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Development tables truncated successfully.');
    }
}
