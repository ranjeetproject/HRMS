<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewFeedbackContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_feedback_contents', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->string('content_for_selection')->nullable();
            $table->string('content_for_rejection')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine="InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interview_feedback_contents');
    }
}
