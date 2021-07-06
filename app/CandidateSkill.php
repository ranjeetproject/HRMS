<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CandidateSkill extends Model
{
    
    protected $hidden = ['created_at', 'updated_at'];

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['recruitment_id','employee_details_id','skill_id','user_id','acquire_date','status'];

    public function skill()
    {
        return $this->belongsTo('App\Skill','skill_id');
    }
}
