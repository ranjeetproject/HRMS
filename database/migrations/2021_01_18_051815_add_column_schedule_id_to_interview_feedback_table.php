<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnScheduleIdToInterviewFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_feedback', function (Blueprint $table) {
            $table->bigInteger('schedule_id')->unsigned()->index()->nullable()->after('active');
            $table->foreign('schedule_id')->references('id')->on('interview_feedback')->onDelete('restrict')->onUpdate('restrict');
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
            $table->dropForeign('interview_feedback_schedule_id_foreign');
            $table->dropIndex('interview_feedback_schedule_id_index');
            $table->dropColumn('schedule_id');
        });
    }
}
