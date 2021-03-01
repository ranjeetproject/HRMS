<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusToEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_details', function (Blueprint $table) {
            $table->tinyInteger('status_probation')->default(0)->comment('1:P;2:C')->after('designation');
            $table->tinyInteger('status_serving')->default(0)->comment('1:S;2:N;3:R')->after('status_probation');
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
            $table->dropColumn('status_probation');
            $table->dropColumn('status_serving');
        });
    }
}
