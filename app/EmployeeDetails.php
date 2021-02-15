<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeeDetails extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['recruitment_id','feedback_id','reporting_head','email','offical_email_id','emp_code','contact_number',
                            'alternate_number','permanent_address','current_address','father_name','mother_name',
                            'date_of_birth','date_of_joining','marital_status','name_of_spouse','total_years_experience',
                            'total_months_experience','highest_qualification','department','designation'];

    public function recruitment()
    {
        return $this->belongsTo('App\Recruitment','recruitment_id');
    }

    public function candidateSkill()
    {
        return $this->hasMany('App\CandidateSkill','recruitment_id');
    }

}
