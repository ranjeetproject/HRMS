<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnExtraHalfDayLeaveToUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->tinyInteger('extra_half_day_leaves_details_view')->default(0)->comment('1:extra_half_day_leaves_details_view')->after('pending_approve_leave_view');
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
            $table->dropColumn('extra_half_day_leaves_details_view');
        });
    }
}
