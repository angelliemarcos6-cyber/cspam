<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AcademicYear;
use Carbon\Carbon;

class ManageAcademicYears extends Command
{
    protected $signature = 'academic:manage';
    protected $description = 'Create new academic year and archive/delete old ones every 7 years';

    public function handle()
    {
        // ─── CREATE NEW YEAR (runs yearly) ──────────────────────────────────────
        $latestYear = AcademicYear::latest('year')->first();
        if ($latestYear) {
            [$start, $end] = explode('-', $latestYear->year);
            $newStart = (int)$end;
            $newEnd = $newStart + 1;
            $newYear = "{$newStart}-{$newEnd}";

            if (! AcademicYear::where('year', $newYear)->exists()) {
                AcademicYear::create([
                    'year'       => $newYear,
                    'start_date' => Carbon::create($newStart, 6, 1)->toDateString(),
                                     'end_date'   => Carbon::create($newEnd, 5, 31)->toDateString(),
                                     'is_current' => true, // Mark as current
                ]);

                // Unmark previous as current
                $latestYear->update(['is_current' => false]);

                $this->info("Created new academic year: {$newYear}");
            }
        }

        // ─── ARCHIVE/DELETE OLD YEARS (every 7 years) ──────────────────────────
        $sevenYearsAgo = Carbon::now()->subYears(7)->year;
        $oldYears = AcademicYear::where('year', '<', "{$sevenYearsAgo}-" . ($sevenYearsAgo + 1))->get();

        foreach ($oldYears as $oldYear) {
            // Option 1: Soft Delete (recommended – add SoftDeletes to model)
            $oldYear->delete();

            // Option 2: Hard Delete (if no soft deletes)
            // $oldYear->forceDelete(); // But cascade delete related data first!

            // Option 3: Archive (move to archive table – advanced)
            // AcademicYearArchive::create($oldYear->toArray());
            // $oldYear->delete();

            $this->info("Archived/Deleted old academic year: {$oldYear->year}");
        }
    }
}
