<?php


namespace App\Repositories;

use App\InterviewFeedback;
use App\Skill;
use App\User;
use App\CandidateSkill;
use App\Recruitment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class InterviewFeedbackRepository
{
    public function insert($inputData,$user)
    {
        $inputData['interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['interview_scheduling_date']));
        $inputData['interview_scheduling_time'] =  Carbon::parse($inputData['interview_scheduling_time'])->format('h:i:s');
        $row = InterviewFeedback::create($inputData);
        if ($row && $row->id > 0) {
            if($row->active){
                $this->sendNotificationForFeedBack($row->id,$user);
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['status' => 1,'interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
            $this->sendNotificationForFeedBack($row->id,$user);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function editFeedback($id)
    {
        $feedback = InterviewFeedback::find($id);
        $feedback['interview_scheduling_date'] = date('d-m-Y',strtotime($feedback['interview_scheduling_date']));
        return $feedback;

    }

    public function updateSave($inputData, $id)
    {
        $inputData['interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['interview_scheduling_date']));
        $inputData['interview_scheduling_time'] =  Carbon::parse($inputData['interview_scheduling_time'])->format('h:i:s');
        $row = InterviewFeedback::find($id);
        if ($row) {
            $row->update($inputData);
            if($row->active){
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['status' => 1,'interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function fetchUsersInterviewer()
    {
        $row = User::get();
        return $row;
    }

    public function sendNotificationForFeedBack($feedbackId,$user)
    {
        
            $feedback = InterviewFeedback::find($feedbackId);
            if ($feedback) {
                $notificationRepo = new NotificationRepository();
                $notificationData = [];
                $notificationData['view_url'] = action('InterviewFeedbackController@store', ['id' => $feedback->id]);
                $notificationData['interview_feedback_id'] = $feedback->id;
                if ($user) {
                    $name = $user->name;
                    $notificationData['user_id'] = $user->id;
                }
                $notificationData['text'] = $name . ' Interview Feedback.';
                $notificationRepo->insert($notificationData);
            }
 
    }
}