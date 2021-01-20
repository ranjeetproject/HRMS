<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFeedbackfinalroundToInterviewFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_feedback', function (Blueprint $table) {
            $table->date('final_round_interview_scheduling_date')->after('interview_scheduling_time')->nullable();
            $table->time('final_round_interview_scheduling_time')->after('final_round_interview_scheduling_date')->nullable();
            $table->bigInteger('offered_ctc')->unsigned()->nullable()->after('schedule_id');
            $table->string('final_round_interviewer_feedback')->nullable()->after('offered_ctc');
            $table->date('date_of_joining')->after('final_round_interviewer_feedback')->nullable();
            $table->tinyInteger('offered')->default(0)->comment('0:Inactive;1:Active')->after('active')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_feedback', function (Blueprint $table) {
            //
        });
    }
}
