<?php

namespace App\Http\Controllers;

use App\Models\TimeSchedule;
use Illuminate\Http\Request;

class TimeScheduleController extends Controller
{
    public function index()
    {
        return TimeSchedule::all(); // Return all schedules
    }
}
