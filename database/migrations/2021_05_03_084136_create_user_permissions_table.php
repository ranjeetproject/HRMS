<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('designation_id')->unsigned()->index();
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('restrict')->onUpdate('restrict');
            $table->tinyInteger('recruitment_view')->default(0)->comment('1:recruitment_view');
            $table->tinyInteger('recruitment_modify')->default(0)->comment('2:recruitment_modify');
            $table->tinyInteger('holiday_view')->default(0)->comment('1:holiday_view');
            $table->tinyInteger('holiday_modify')->default(0)->comment('2:holiday_modify');
            $table->tinyInteger('performance_view')->default(0)->comment('1:performance_view');
            $table->tinyInteger('performance_modify')->default(0)->comment('2:performance_modify');
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
        Schema::dropIfExists('user_permissions');
    }
}
