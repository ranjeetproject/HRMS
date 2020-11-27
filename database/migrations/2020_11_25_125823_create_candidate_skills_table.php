<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_skills', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('recruitment_id')->unsigned()->index();
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('skill_id')->unsigned()->index();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('candidate_skills');
    }
}
