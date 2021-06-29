<?php


namespace App\Repositories;

use App\InterviewFeedback;
use App\Skill;
use App\InterviewFeedbackContent;
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
use Mail;


class InterviewFeedbackRepository
{
    public function insert($inputData,$user)
    {
       
        $inputData['interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['interview_scheduling_date']));
        $inputData['interview_scheduling_time'] =  Carbon::parse($inputData['interview_scheduling_time'])->format('h:i:s');
        $row = InterviewFeedback::create($inputData);
        if ($row && $row->id > 0) {
            if($row->active == 1){
                $this->sendNotificationForFeedBack($row->id,$user);
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['status' => 1,'interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
            if($row->active == 2){
                $Rejection = InterviewFeedbackContent::find(2);
                $candidateEmail = Recruitment::where('id','=',  $row->recruitment_id)->first(['email_id']);
                Mail::send('emails.rejection', ['row' => $Rejection], function ($m) use ($candidateEmail,$user) {
                    $m->from($user->email);
                    $m->to($candidateEmail->email_id)->subject('Rejected');
                });
                $this->sendNotificationForFeedBack($row->id,$user);
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['status' => 1,'interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
            if($row->active == 3){
                $this->sendNotificationForFeedBack($row->id,$user);
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
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

    public function updateSave($inputData,$id,$user)
    {
        $inputData['interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['interview_scheduling_date']));
        $inputData['interview_scheduling_time'] =  Carbon::parse($inputData['interview_scheduling_time'])->format('h:i:s');
        $row = InterviewFeedback::find($id);
        if ($row) {
            $row->update($inputData);
            if($row->active == 1){
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['status' => 1,'interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
            if($row->active == 2){
                $Rejection = InterviewFeedbackContent::find(2);
                $candidateEmail = Recruitment::where('id','=',  $row->recruitment_id)->first(['email_id']);
                Mail::send('emails.rejection', ['row' => $Rejection], function ($m) use ($candidateEmail,$user) {
                    $m->from($user->email);
                    $m->to($candidateEmail->email_id)->subject('Rejected');
                });
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['status' => 1,'interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
            if($row->active == 3){
                Recruitment::where('id','=',$row->recruitment_id)
                ->update(['interview_status' => 2]);
                return ['success' => true,'active' => $row->active];
            }
        } else {
            return ['success' => false];
        }
    }

    public function fetchUsersInterviewer()
    {
        $row = User::Where('id','!=',1)->get();
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