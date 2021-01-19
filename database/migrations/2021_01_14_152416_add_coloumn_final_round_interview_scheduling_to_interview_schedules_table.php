<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnFinalRoundInterviewSchedulingToInterviewSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->date('final_round_interview_scheduling_date')->after('interview_scheduling_time')->nullable();
            $table->time('final_round_interview_scheduling_time')->after('final_round_interview_scheduling_date')->nullable();

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
            $table->dropColumn('final_round_interview_scheduling_date');
            $table->dropColumn('final_round_interview_scheduling_time');
        });
    }
}
