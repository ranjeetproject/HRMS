<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLeaveApplicationIdToEmployeesExtraAndHalfdayLeavesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees_extra_and_halfday_leaves_details', function (Blueprint $table) {
            $table->bigInteger('leave_id')->unsigned()->index()->nullable()->after('user_id');
            $table->foreign('leave_id')->references('id')->on('leave_applications')->onDelete('restrict')->onUpdate('restrict');
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
            $table->dropForeign('employees_extra_and_halfday_leaves_details_leave_id_foreign');
            $table->dropIndex('employees_extra_and_halfday_leaves_details_leave_id_index');
            $table->dropColumn('leave_id');
        });
    }
}
