<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColoumnInterviewSchedulingDateTimeToInterviewSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->dropColumn('interview_scheduling_date');
            $table->dropColumn('interview_scheduling_time');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->dateTime('interview_scheduling_date');
            $table->time('interview_scheduling_time');
        });
    }
}
