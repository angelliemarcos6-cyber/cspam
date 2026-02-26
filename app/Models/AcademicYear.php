<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'start_date',
        'end_date',
        'is_current',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_current' => 'boolean',
    ];

    // Helper: Get the current academic year
    public static function current()
    {
        return self::where('is_current', true)->first();
    }

    // Relationships (you'll use these soon)
    public function schoolYearlyData()
    {
        return $this->hasMany(SchoolYearlyData::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Section::class);
    }
}
