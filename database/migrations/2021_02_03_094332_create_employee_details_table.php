<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('recruitment_id')->unsigned()->index();
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('feedback_id')->unsigned()->index();
            $table->foreign('feedback_id')->references('id')->on('interview_feedback')->onDelete('restrict')->onUpdate('restrict');
            $table->string('reporting_head');
            $table->string('email')->unique();
            $table->bigInteger('emp_code');
            $table->bigInteger('contact_number');
            $table->bigInteger('alternate_number');
            $table->text('permanent_address');
            $table->text('current_address')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('date_of_birth');
            $table->date('date_of_joining');
            $table->string('marital_status')->nullable();
            $table->string('name_of_spouse')->nullable();
            $table->integer('total_years_experience');
            $table->integer('total_months_experience');
            $table->string('highest_qualification');
            $table->string('department');
            $table->string('designation');
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
        Schema::dropIfExists('employee_details');
    }
}
