<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFinalroundinterviewuserToInterviewFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_feedback', function (Blueprint $table) {
            $table->bigInteger('final_round_interview_user_id')->unsigned()->index()->nullable()->after('user_id');
            $table->foreign('final_round_interview_user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
            $table->dropForeign('interview_feedback_final_round_interview_user_id_foreign');
            $table->dropIndex('interview_feedback_final_round_interview_user_id_index');
            $table->dropColumn('final_round_interview_user_id');
        });
    }
}

