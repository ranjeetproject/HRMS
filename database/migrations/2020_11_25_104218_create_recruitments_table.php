<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->string('name_of_candidate');
            $table->bigInteger('mobile_number')->unsigned();
            $table->bigInteger('alternate_number')->unsigned()->nullable();
            $table->bigInteger('total_years_experience')->unsigned()->nullable();
            $table->bigInteger('total_months_experience')->unsigned()->nullable();
            $table->bigInteger('relevent_years_experience')->unsigned()->nullable();
            $table->bigInteger('relevent_months_experience')->unsigned()->nullable();
            $table->string('address');
            $table->string('email_id',191)->nullable();
            $table->string('application_for');
            $table->string('highest_qualification');
            $table->bigInteger('current_ctc')->unsigned()->nullable();
            $table->bigInteger('expected_ctc')->unsigned()->nullable();
            $table->string('current_location');
            $table->bigInteger('notice_period')->nullable();
            $table->string('special_remarks');
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
        Schema::dropIfExists('recruitments');
    }
}
