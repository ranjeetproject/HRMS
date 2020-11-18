<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_info', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->string('designation');
            $table->date('join_date');
            $table->string('pan_no');
            $table->bigInteger('account_no')->unsigned();
            $table->bigInteger('gross_payout')->unsigned();
            $table->bigInteger('deduction_for_absent')->unsigned();
            $table->bigInteger('tds')->unsigned();
            $table->bigInteger('loan')->unsigned();
            $table->bigInteger('gross_deduction')->unsigned();
            $table->bigInteger('net_pay')->unsigned();
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
        Schema::dropIfExists('account_info');
    }
}
