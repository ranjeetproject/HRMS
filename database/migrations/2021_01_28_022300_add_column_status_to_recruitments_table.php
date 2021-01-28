<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusToRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->comment('0:Normal;1:F;2:O')->after('upload_resume');

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
            $table->dropColumn('status');
        });
    }
}
