<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnInterviewSchedulingDateTimeToInterviewSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->date('interview_scheduling_date')->after('recruitment_id')->nullable();
            $table->time('interview_scheduling_time')->after('interview_scheduling_date')->nullable();
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
            $table->dropColumn('interview_scheduling_date');
            $table->dropColumn('interview_scheduling_time');
        });
    }
}
