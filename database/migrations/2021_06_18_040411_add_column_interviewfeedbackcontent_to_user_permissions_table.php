<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInterviewfeedbackcontentToUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->tinyInteger('interview_feedback_content_view')->default(0)->comment('1:interview_feedback_content_view')->after('released_employees_modify');
            $table->tinyInteger('interview_feedback_content_modify')->default(0)->comment('2:interview_feedback_content_modify')->after('interview_feedback_content_view');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->dropColumn('interview_feedback_content_view');
            $table->dropColumn('interview_feedback_content_modify');

        });
    }
}
