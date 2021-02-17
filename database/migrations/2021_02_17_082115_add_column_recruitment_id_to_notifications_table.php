<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRecruitmentIdToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('recruitment_id')->unsigned()->index()->nullable()->after('view_url');
            $table->foreign('recruitment_id')->references('id')->on('recruitments')
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
            $table->dropForeign('notifications_recruitment_id_foreign');
            $table->dropIndex('notifications_recruitment_id_index');
            $table->dropColumn('recruitment_id');
        });
    }
}
