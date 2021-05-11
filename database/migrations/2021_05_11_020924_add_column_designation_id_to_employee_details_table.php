<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDesignationIdToEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_details', function (Blueprint $table) {
             $table->bigInteger('designation_id')->unsigned()->index()->nullable()->after('department_id');;
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('restrict')->onUpdate('restrict');
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
            $table->dropForeign('employee_details_designation_id_foreign');
            $table->dropIndex('employee_details_designation_id_index');
            $table->dropColumn('designation_id');
        });
    }
}
