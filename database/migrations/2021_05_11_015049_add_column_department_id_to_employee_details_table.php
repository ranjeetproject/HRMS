<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDepartmentIdToEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_details', function (Blueprint $table) {
            $table->bigInteger('department_id')->unsigned()->index()->nullable()->after('highest_qualification');;
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_details', function (Blueprint $table) {
            $table->dropForeign('employee_details_department_id_foreign');
            $table->dropIndex('employee_details_department_id_index');
            $table->dropColumn('department_id');
        });
    }
}
