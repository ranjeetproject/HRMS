<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusToInterviewFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_feedback', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->comment('0:Normal;1:Delete')->after('date_of_joining');

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
            $table->dropColumn('status');
        });
    }
}
