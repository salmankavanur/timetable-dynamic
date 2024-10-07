<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('time_schedules', function (Blueprint $table) {
            if (!Schema::hasColumn('time_schedules', 'student_id')) {
                $table->unsignedBigInteger('student_id')->nullable();
                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            }

            if (!Schema::hasColumn('time_schedules', 'platform_id')) {
                $table->unsignedBigInteger('platform_id')->nullable();
                $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            }

            if (!Schema::hasColumn('time_schedules', 'day')) {
                $table->string('day')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('time_schedules', function (Blueprint $table) {
            if (Schema::hasColumn('time_schedules', 'student_id')) {
                $table->dropForeign(['student_id']);
                $table->dropColumn('student_id');
            }

            if (Schema::hasColumn('time_schedules', 'platform_id')) {
                $table->dropForeign(['platform_id']);
                $table->dropColumn('platform_id');
            }

            if (Schema::hasColumn('time_schedules', 'day')) {
                $table->dropColumn('day');
            }
        });
    }
};
