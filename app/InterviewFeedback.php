<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InterviewFeedback extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['recruitment_id','interview_scheduling_date','interview_scheduling_time','user_id','interviewer_rating','interviewer_feedback','active'];

    public function recruitment()
    {
        return $this->belongsTo('App\Recruitment','recruitment_id');
    }
}
