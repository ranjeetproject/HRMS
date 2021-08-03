<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEmployeesleavesToUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->tinyInteger('employees_leaves_view')->default(0)->comment('1:employees_leaves_view')->after('pending_approve_leave_view');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->dropColumn('employees_leaves_view');
        });
    }
}
