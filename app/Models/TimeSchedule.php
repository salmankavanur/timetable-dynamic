<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSchedule extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
