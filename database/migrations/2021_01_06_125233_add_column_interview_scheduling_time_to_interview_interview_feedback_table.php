<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInterviewSchedulingTimeToInterviewInterviewFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_feedback', function (Blueprint $table) {
            $table->time('interview_scheduling_time')->after('interview_scheduling_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_interview_feedback', function (Blueprint $table) {
            $table->dropColumn('interview_scheduling_time');
        });
    }
}
