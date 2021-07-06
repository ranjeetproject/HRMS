<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEmployeedetailsidToCandidateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_skills', function (Blueprint $table) {
            $table->bigInteger('employee_details_id')->unsigned()->index()->nullable()->after('recruitment_id');
            $table->foreign('employee_details_id')->references('id')->on('employee_details')->onDelete('restrict')->onUpdate('restrict');
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
            $table->dropForeign('candidate_skills_employee_details_id_foreign');
            $table->dropIndex('candidate_skills_employee_details_id_index');
            $table->dropColumn('employee_details_id');
        });
    }
}
