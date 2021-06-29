<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserPermission extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['module_id','department_id','designation_id','recruitment_view','recruitment_modify','holiday_view','holiday_modify','performance_view','performance_modify','add_skills_view',
                        'add_skills_modify','final_round_list_view','final_round_list_modify','offered_candidate_list_view','offered_candidate_list_modify','current_employee_view','current_employee_modify',
                        'user_log_view','salary_set_up_view','salary_set_up_modify','released_employees_view','released_employees_modify','interview_feedback_content_view','interview_feedback_content_modify',
                        'rejected_view','leave_application_view','leave_application_modify','team_member_view',
                        'team_member_modify','skill_acquired_view','skill_acquired_modify','approved_skills_view','approved_skills_modify','designation_view','designation_modify','department_view','department_modify',
                        'user_permission_view','user_permission_modify'];
}
