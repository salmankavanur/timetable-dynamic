<?php

namespace App\Http\Controllers;

use App\Models\TimeSchedule;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        // Fetch time schedules from the database
        $schedules = TimeSchedule::with('student', 'platform')->get();
        return view('timetable', compact('schedules'));
    }
}
