<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnViewModifyToUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->tinyInteger('add_skills_view')->default(0)->comment('1:add_skill_view')->after('performance_modify');
            $table->tinyInteger('add_skills_modify')->default(0)->comment('2:add_skills_modify')->after('add_skills_view');
            $table->tinyInteger('final_round_list_view')->default(0)->comment('1:final_round_list_view')->after('add_skills_modify');
            $table->tinyInteger('final_round_list_modify')->default(0)->comment('2:final_round_list_modify')->after('final_round_list_view');
            $table->tinyInteger('offered_candidate_list_view')->default(0)->comment('1:offered_candidate_list_view')->after('final_round_list_modify');
            $table->tinyInteger('offered_candidate_list_modify')->default(0)->comment('2:offered_candidate_list_modify')->after('offered_candidate_list_view');
            $table->tinyInteger('current_employee_view')->default(0)->comment('1:current_employee_view')->after('offered_candidate_list_modify');
            $table->tinyInteger('current_employee_modify')->default(0)->comment('2:current_employee_modify')->after('current_employee_view');
            $table->tinyInteger('user_log_view')->default(0)->comment('1:user_log_view')->after('current_employee_modify');
            $table->tinyInteger('salary_set_up_view')->default(0)->comment('1:salary_set_up_view')->after('user_log_view');
            $table->tinyInteger('salary_set_up_modify')->default(0)->comment('2:salary_set_up_modify')->after('salary_set_up_view');
            $table->tinyInteger('released_employees_view')->default(0)->comment('1:released_employees_view')->after('salary_set_up_modify');
            $table->tinyInteger('released_employees_modify')->default(0)->comment('2:released_employees_modify')->after('released_employees_view');
            $table->tinyInteger('leave_application_view')->default(0)->comment('1:leave_application_view')->after('released_employees_modify');
            $table->tinyInteger('leave_application_modify')->default(0)->comment('2:leave_application_modify')->after('leave_application_view');
            $table->tinyInteger('team_member_view')->default(0)->comment('1:team_member_view')->after('leave_application_modify');
            $table->tinyInteger('team_member_modify')->default(0)->comment('2:team_member_modify')->after('team_member_view');
            $table->tinyInteger('skill_acquired_view')->default(0)->comment('1:skill_acquired_view')->after('team_member_modify');
            $table->tinyInteger('skill_acquired_modify')->default(0)->comment('2:skill_acquired_modify')->after('skill_acquired_view');
            $table->tinyInteger('approved_skills_view')->default(0)->comment('1:approved_skills_view')->after('skill_acquired_modify');
            $table->tinyInteger('approved_skills_modify')->default(0)->comment('2:approved_skills_modify')->after('approved_skills_view');
            $table->tinyInteger('designation_view')->default(0)->comment('1:designation_view')->after('approved_skills_modify');
            $table->tinyInteger('designation_modify')->default(0)->comment('2:designation_modify')->after('designation_view');
            $table->tinyInteger('department_view')->default(0)->comment('1:department_view')->after('designation_modify');
            $table->tinyInteger('department_modify')->default(0)->comment('2:department_modify')->after('department_view');
            $table->tinyInteger('user_permission_view')->default(0)->comment('1:user_permission_view')->after('department_modify');
            $table->tinyInteger('user_permission_modify')->default(0)->comment('2:user_permission_modify')->after('user_permission_view');
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
            $table->dropColumn('add_skills_view');
            $table->dropColumn('add_skills_modify');
            $table->dropColumn('final_round_list_view');
            $table->dropColumn('final_round_list_modify');
            $table->dropColumn('offered_candidate_list_view');
            $table->dropColumn('offered_candidate_list_modify');
            $table->dropColumn('current_employee_view');
            $table->dropColumn('current_employee_modify');
            $table->dropColumn('user_log_view');
            $table->dropColumn('salary_set_up_view');
            $table->dropColumn('salary_set_up_modify');
            $table->dropColumn('released_employees_view');
            $table->dropColumn('released_employees_modify');
            $table->dropColumn('leave_application_view');
            $table->dropColumn('leave_application_modify');
            $table->dropColumn('team_member_view');
            $table->dropColumn('team_member_modify');
            $table->dropColumn('approved_skills_view');
            $table->dropColumn('approved_skills_modify');
            $table->dropColumn('designation_view');
            $table->dropColumn('designation_modify');
            $table->dropColumn('department_view');
            $table->dropColumn('department_modify');
            $table->dropColumn('user_permission_view');
            $table->dropColumn('user_permission_modify');
        });
    }
}
