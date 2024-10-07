<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this line

class Student extends Model
{
    use SoftDeletes; // Add this line

    protected $fillable = ['name']; // Ensure 'name' is fillable

    public function schedules()
    {
        return $this->hasMany(TimeSchedule::class);
    }
}
