<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->foreignId('baladiyas_id')->constrained('baladiyas');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('baladiyas_id')->constrained('baladiyas');
            $table->foreignId('group_id')->constrained('groups');
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('section_id')->constrained('sections');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreignId('year_id')->constrained('years');
        });

        Schema::table('years', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained('departments');
        });

        Schema::table('days', function (Blueprint $table) {
            $table->foreignId('time_table_id')->constrained('time_tables');
        });

        Schema::table('lessens', function (Blueprint $table) {
            $table->foreignId('day_id')->constrained('days');
            $table->foreignId('module_id')->constrained('modules');
            $table->foreignId('teacher_id')->constrained('teachers');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('key_id')->constrained('keys');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
