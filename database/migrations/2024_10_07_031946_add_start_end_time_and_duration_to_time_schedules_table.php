<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartEndTimeAndDurationToTimeSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('time_schedules', function (Blueprint $table) {
            if (!Schema::hasColumn('time_schedules', 'start_time')) {
                $table->time('start_time')->nullable();
            }

            if (!Schema::hasColumn('time_schedules', 'end_time')) {
                $table->time('end_time')->nullable();
            }

            if (!Schema::hasColumn('time_schedules', 'duration')) {
                $table->float('duration')->nullable();  // Store duration in hours
            }
        });
    }

    public function down()
    {
        Schema::table('time_schedules', function (Blueprint $table) {
            if (Schema::hasColumn('time_schedules', 'start_time')) {
                $table->dropColumn('start_time');
            }

            if (Schema::hasColumn('time_schedules', 'end_time')) {
                $table->dropColumn('end_time');
            }

            if (Schema::hasColumn('time_schedules', 'duration')) {
                $table->dropColumn('duration');
            }
        });
    }
}
