<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public function schedules()
    {
        return $this->hasMany(TimeSchedule::class);
    }
}
