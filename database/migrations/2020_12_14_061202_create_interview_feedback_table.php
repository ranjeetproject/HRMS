<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_feedback', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('recruitment_id')->unsigned()->index();
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('restrict')->onUpdate('restrict');
            $table->dateTime('interview_scheduling_date');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('interviewer_rating');
            $table->string('interviewer_feedback');
            $table->tinyInteger('active')->default(0)->comment('0:Inactive;1:Active');
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
        Schema::dropIfExists('interview_feedback');
    }
}
