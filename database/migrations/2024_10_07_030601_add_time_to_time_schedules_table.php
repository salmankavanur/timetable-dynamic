<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('time_schedules', function (Blueprint $table) {
            if (!Schema::hasColumn('time_schedules', 'time')) {
                $table->time('time')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('time_schedules', function (Blueprint $table) {
            if (Schema::hasColumn('time_schedules', 'time')) {
                $table->dropColumn('time');
            }
        });
    }
};
