<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRecruitmentIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('recruitment_id')->unsigned()->index()->nullable()->after('employee_details_id');;
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_recruitment_id_foreign');
            $table->dropIndex('users_recruitment_id_index');
            $table->dropColumn('recruitment_id');
        });
    }
}
