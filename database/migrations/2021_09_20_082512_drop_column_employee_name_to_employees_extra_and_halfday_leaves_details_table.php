<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnEmployeeNameToEmployeesExtraAndHalfdayLeavesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees_extra_and_halfday_leaves_details', function (Blueprint $table) {
            $table->dropColumn('employee_name');
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
            $table->string('employee_name')->after('leave_id');
        });
    }
}
