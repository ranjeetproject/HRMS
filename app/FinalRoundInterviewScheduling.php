<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalRoundInterviewScheduling extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['recruitment_id','final_round_interview_scheduling_date','final_round_interview_scheduling_time','final_round_interview_user_id'];
}
