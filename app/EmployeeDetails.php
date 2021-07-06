<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeeDetails extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['recruitment_id','feedback_id','name_of_candidate','reporting_head','email','offical_email_id','emp_code','contact_number',
                            'alternate_number','permanent_address','current_address','father_name','mother_name',
                            'date_of_birth','date_of_joining','marital_status','name_of_spouse','total_years_experience',
                            'total_months_experience','highest_qualification','department_id','designation_id','status_probation','status_serving','date_of_released','date_of_confirmed'];

    public function recruitment()
    {
        return $this->belongsTo('App\Recruitment','recruitment_id');
    }

    public function candidateSkill()
    {
        return $this->hasMany('App\CandidateSkill','recruitment_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function designation()
    {
        return $this->belongsTo('App\Designation');
    }
    public function existingEmployee()
    {
        return $this->hasMany('App\CandidateSkill','employee_details_id');
    }
}
