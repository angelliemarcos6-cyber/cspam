<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        $startYear   = 2026;
        $yearsToSeed = 7;  // 2026-2027 - 2032-2033

        for ($i = 0; $i < $yearsToSeed; $i++) {
            $yearStart = $startYear + $i;
            $yearEnd   = $yearStart + 1;

            $name = "{$yearStart}-{$yearEnd}";

            DB::table('academic_years')->updateOrInsert(
                ['name' => $name],
                [
                    'start_date'  => "{$yearStart}-06-01",
                    'end_date'    => "{$yearEnd}-03-31",
                    'is_current'   => ($i === 0),
                                                        'created_at'  => now(),
                                                        'updated_at'  => now(),
                ]
            );
        }

        $this->command->info("Seeded {$yearsToSeed} academic years (from {$startYear}-".($startYear+1)." to ".($startYear+$yearsToSeed-1)."-".($startYear+$yearsToSeed).")");
    }
}
