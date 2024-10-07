<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
                $startTime = Carbon::parse($timeSchedule->start_time);
                $endTime = Carbon::parse($timeSchedule->end_time);

                // Ensure that end time is after start time
                if ($endTime->greaterThan($startTime)) {
                    $timeSchedule->duration = $startTime->diffInMinutes($endTime) / 60;  // Calculate duration in hours
                } else {
                    // Set the duration to zero if the times are invalid
                    $timeSchedule->duration = 0;
                }
            }
        });
    }

    // Additional validation to prevent saving incorrect data
    public function save(array $options = [])
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);

        // Ensure start_time is before end_time
        if ($startTime->greaterThanOrEqualTo($endTime)) {
            throw new \Exception('End time must be after start time.');
        }

        parent::save($options);
    }
}
