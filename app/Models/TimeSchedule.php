<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSchedule extends Model
{
    protected $fillable = ['student_id', 'platform_id', 'day', 'start_time', 'end_time', 'duration'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    // Automatically calculate the duration before saving the schedule
    protected static function booted()
    {
        static::saving(function ($timeSchedule) {
            if ($timeSchedule->start_time && $timeSchedule->end_time) {
                $startTime = \Carbon\Carbon::parse($timeSchedule->start_time);
                $endTime = \Carbon\Carbon::parse($timeSchedule->end_time);
                $timeSchedule->duration = $endTime->diffInMinutes($startTime) / 60;  // Calculate duration in hours
            }
        });
    }
}
