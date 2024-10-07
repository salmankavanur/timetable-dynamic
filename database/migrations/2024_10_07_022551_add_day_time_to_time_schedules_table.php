<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('time_schedules', function (Blueprint $table) {
        $table->string('day');  // to store the day of the week
        $table->time('start_time');  // to store the starting time of the schedule
        $table->time('end_time');    // to store the ending time of the schedule
    });
}

public function down()
{
    Schema::table('time_schedules', function (Blueprint $table) {
        $table->dropColumn(['day', 'start_time', 'end_time']);
    });
}

};
