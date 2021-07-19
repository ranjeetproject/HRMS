<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCurrentCtcAndExpectedCtcToRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->string('current_ctc')->nullable()->after('highest_qualification');
            $table->string('expected_ctc')->nullable()->after('current_ctc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->dropColumn('current_ctc');
            $table->dropColumn('expected_ctc');
        });
    }
}
