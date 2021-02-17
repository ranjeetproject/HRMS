<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSchduleIdToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('interview_schedule_id')->unsigned()->index()->nullable()->after('recruitment_id');
            $table->foreign('interview_schedule_id')->references('id')->on('interview_schedules')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_interview_schedule_id_foreign');
            $table->dropIndex('notifications_interview_schedule_id_index');
            $table->dropColumn('interview_schedule_id');
        });
    }
}
