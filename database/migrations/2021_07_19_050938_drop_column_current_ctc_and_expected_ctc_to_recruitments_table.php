<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnCurrentCtcAndExpectedCtcToRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->dropColumn('current_ctc');
            $table->dropColumn('expected_ctc');
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
            $table->bigInteger('current_ctc')->unsigned()->nullable();
            $table->bigInteger('expected_ctc')->unsigned()->nullable();
        });
    }
}
