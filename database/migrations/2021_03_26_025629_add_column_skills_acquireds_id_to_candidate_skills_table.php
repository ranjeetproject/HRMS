<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSkillsAcquiredsIdToCandidateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_skills', function (Blueprint $table) {
            $table->bigInteger('skills_acquireds_id')->unsigned()->index()->nullable()->after('recruitment_id');;
            $table->foreign('skills_acquireds_id')->references('id')->on('skills_acquireds')->onDelete('restrict')->onUpdate('restrict');
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
            $table->dropForeign('candidate_skills_skills_acquireds_id_foreign');
            $table->dropIndex('candidate_skills_skills_acquireds_id_index');
            $table->dropColumn('skills_acquireds_id');
        });
    }
}
