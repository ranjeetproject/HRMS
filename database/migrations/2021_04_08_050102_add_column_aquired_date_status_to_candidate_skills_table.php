<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAquiredDateStatusToCandidateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_skills', function (Blueprint $table) {
            $table->date('acquire_date')->after('skill_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0:normal;1:approve;2:disapprove;')->after('acquire_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_skills', function (Blueprint $table) {
            $table->dropColumn('acquire_date');
            $table->dropColumn('status');
        });
    }
}
