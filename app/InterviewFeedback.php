<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InterviewFeedback extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['recruitment_id','interview_scheduling_date','interview_scheduling_time','final_round_interview_scheduling_date','final_round_interview_scheduling_time','user_id','final_round_interview_user_id','offered_ctc','final_round_interviewer_feedback','interviewer_rating','interviewer_feedback','date_of_joining','active','offered','schedule_id','status'];

    public function recruitment()
    {
        return $this->belongsTo('App\Recruitment','recruitment_id');
    }
    public function schedule()
    {
        return $this->belongsTo('App\InterviewSchedule','schedule_id');
    }
}
