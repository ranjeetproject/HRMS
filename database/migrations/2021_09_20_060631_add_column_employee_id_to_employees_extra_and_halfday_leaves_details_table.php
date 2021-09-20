<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEmployeeIdToEmployeesExtraAndHalfdayLeavesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees_extra_and_halfday_leaves_details', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->index()->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees_extra_and_halfday_leaves_details', function (Blueprint $table) {
            $table->dropForeign('employees_extra_and_halfday_leaves_details_user_id_foreign');
            $table->dropIndex('employees_extra_and_halfday_leaves_details_user_id_index');
            $table->dropColumn('user_id');
        });
    }
}
