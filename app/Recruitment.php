<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Recruitment extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['name_of_candidate','mobile_number','alternate_number','total_years_experience','total_months_experience','relevent_years_experience','relevent_months_experience','address','email_id','application_for','highest_qualification','current_ctc','expected_ctc','current_location','notice_period','special_remarks'];

    public function candidateSkill()
    {
        return $this->hasMany('App\CandidateSkill','recruitment_id');
    }
}

