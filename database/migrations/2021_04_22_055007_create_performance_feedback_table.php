<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_feedback', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('team_member_name_id')->unsigned()->index();
            $table->foreign('team_member_name_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->tinyInteger('performance_type')->default(0)->comment('0:DEFAULT;1:EP;2:CT;3:RG;4:PP;5:CE');
            $table->date('review_date');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->engine="InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_feedback');
    }
}
