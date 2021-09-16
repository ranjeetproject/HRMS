<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesExtraAndHalfdayLeavesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_extra_and_halfday_leaves_details', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->string('employee_name');
            $table->date('apply_date');
            $table->integer('extra_leaves')->nullable();
            $table->integer('leaves')->nullable();
            $table->integer('half_day_leaves')->nullable();
            $table->tinyInteger('narration')->default(0)->comment('1:FL;2:HL;3:EW;');
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
        Schema::dropIfExists('employees_extra_and_halfday_leaves_details');
    }
}
