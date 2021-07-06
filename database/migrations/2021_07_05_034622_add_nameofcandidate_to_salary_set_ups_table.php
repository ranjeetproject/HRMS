<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameofcandidateToSalarySetUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salary_set_ups', function (Blueprint $table) {
            $table->string('name_of_candidate')->nullable()->after('employee_details_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_set_ups', function (Blueprint $table) {
            $table->dropColumn('name_of_candidate');
        });
    }
}
