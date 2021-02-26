<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySetUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_set_ups', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('recruitment_id')->unsigned()->index();
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('employee_details_id')->unsigned()->index()->nullable();
            $table->foreign('employee_details_id')->references('id')->on('employee_details')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('employee_code');
            $table->string('email_id')->unique();
            $table->string('salary_type');
            $table->float('gross_salary');
            $table->float('ctc',8,2);
            $table->float('basic');
            $table->float('hra');
            $table->float('other_allowances');
            $table->float('epf');
            $table->float('esi');
            $table->float('p_tax');
            $table->float('tds');
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
        Schema::dropIfExists('salary_set_ups');
    }
}
