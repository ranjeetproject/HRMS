<?php


namespace App\Repositories;

use App\Recruitment;
use App\InterviewSchedule;
use App\InterviewFeedback;
use App\Skill;
use App\User;
use App\CandidateSkill;
use App\FinalRoundInterviewScheduling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class FinalRoundRepository
{
    public function getAll()
    {
        $data = InterviewFeedback::orderBy('interview_feedback.created_at', 'DESC')
                ->leftJoin('recruitments','recruitments.id','=','interview_feedback.recruitment_id')
                ->leftJoin('interview_schedules','interview_schedules.id','=','interview_feedback.schedule_id')
                ->where('interview_feedback.active','=',1)
                ->where('recruitments.status','!=',2)
                ->where('recruitments.status','!=',0)->get([
                    'interview_feedback.id','interview_feedback.schedule_id','interview_feedback.recruitment_id','recruitments.name_of_candidate','recruitments.mobile_number','recruitments.email_id',
                    'interview_schedules.final_round_interview_scheduling_date','interview_schedules.final_round_interview_scheduling_time'
            ]);
     
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('FinalRoundController@finalRoundInterviewScheduling',$row->id).'" data-toggle="tooltip" data-placement="top" title="Final Round Scheduling" class="btn btn-primary">
                <i class="fas fa-user-tie"></i>
                </a>
                <a href="'.action('FinalRoundController@finalRoundInterviewFeedback',$row->id).'" data-toggle="tooltip" data-placement="top" title="Final Round Scheduling" class="btn btn-success">
                <i class="fas fa-check-square"></i>
                </a>
                <form method="POST" action="' . action('FinalRoundController@finalRoundInterviewDestroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
                onsubmit="return confirm(\'Are you sure want to delete this row?\');"><input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
                        </form>';
                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }
    public function fetchCandidateName($id)
    {
        $recruitmentCandidateName = InterviewFeedback::where('id','=',$id)->first();
        return $recruitmentCandidateName;
    }

    public function fetchUsersInterviewer()
    {
        $row = User::get();
        return $row;
    }
    
    public function fetchFinalRoundSchedule($id){
        $finalRoundSchedule = InterviewSchedule::where('id','=',$id)->first();
        return $finalRoundSchedule;
    }

    public function fetchFinalFeedbackRound($id){
        $finalFeedbackRoundSchedule = InterviewFeedback::find($id);
        return $finalFeedbackRoundSchedule;
    }

    public function insert($inputData,$user)
    {
        $inputData['final_round_interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['final_round_interview_scheduling_date']));
        $inputData['final_round_interview_scheduling_time'] =  Carbon::parse($inputData['final_round_interview_scheduling_time'])->format('h:i:s');
        $row = InterviewSchedule::where('id', $inputData['schedule_id'])
              ->update(['final_round_interview_scheduling_date' => $inputData['final_round_interview_scheduling_date'],
                        'final_round_interview_scheduling_time' => $inputData['final_round_interview_scheduling_time'],
                        'recruitment_id' => $inputData['recruitment_id'],
                        'final_round_interview_user_id' => $inputData['final_round_interview_user_id'],
              ]);
      
        if ($row) {
            $this->sendNotificationForSchedule($inputData['schedule_id'],$user);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
    public function updateSave($inputData,$id)
    {
        $inputData['final_round_interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['final_round_interview_scheduling_date']));
        $inputData['final_round_interview_scheduling_time'] =  Carbon::parse($inputData['final_round_interview_scheduling_time'])->format('h:i:s');
        $row = InterviewSchedule::find($id);
        if ($row) {
            $row->update(['final_round_interview_scheduling_date' => $inputData['final_round_interview_scheduling_date'],
                        'final_round_interview_scheduling_time' => $inputData['final_round_interview_scheduling_time'],
                        'recruitment_id' => $inputData['recruitment_id'],
                        'final_round_interview_user_id' => $inputData['final_round_interview_user_id'],
            ]);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function finalRoundFeedbackinsert($inputData,$user)
    {
        $inputData['final_round_interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['final_round_interview_scheduling_date']));
        $inputData['date_of_joining'] = date('Y-m-d',strtotime($inputData['date_of_joining']));
        $inputData['final_round_interview_scheduling_time'] =  Carbon::parse($inputData['final_round_interview_scheduling_time'])->format('h:i:s');

        $row = InterviewFeedback::where('id', $inputData['feedback_id'])
        ->update(['final_round_interview_scheduling_date' => $inputData['final_round_interview_scheduling_date'],
                  'final_round_interview_scheduling_time' => $inputData['final_round_interview_scheduling_time'],
                  'final_round_interview_user_id' => $inputData['final_round_interview_user_id'],
                  'final_round_interviewer_feedback' => $inputData['final_round_interviewer_feedback'],
                  'offered_ctc' => $inputData['offered_ctc'],
                  'date_of_joining' => $inputData['date_of_joining'],
                  'offered' => $inputData['offered'],
        ]);
        
        if($row) {
            if($inputData['offered'] == 1){
                Recruitment::where('id','=',$inputData['recruitment_id'])
                ->update(['status' => 2 ]);
                $this->sendNotificationForFinalFeedBack($inputData['feedback_id'],$user);
                return ['success' => true];
            }
            $this->sendNotificationForFinalFeedBack($inputData['feedback_id'],$user);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
    public function finalRoundInterviwFeedbackUpdate($inputData,$id)
    {
    
        $inputData['date_of_joining'] = date('Y-m-d',strtotime($inputData['date_of_joining']));
        $row = InterviewFeedback::find($id);
        if($row) 
        {
            $row->update(['final_round_interviewer_feedback' => $inputData['final_round_interviewer_feedback'],
            'offered_ctc' => $inputData['offered_ctc'],
            'date_of_joining' => $inputData['date_of_joining'],
            'offered' => $inputData['offered'],
            ]);
            if($inputData['offered'] == 1){
                Recruitment::where('id','=',$inputData['recruitment_id'])
                ->update(['status' => 2 ]);
                return ['success' => true];
            }
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id)
    {
        $finalFeedback = InterviewFeedback::where('id', '=' ,$id)->first();
        $row = Recruitment::where('id','=',$finalFeedback->recruitment_id)
        ->update(['status' => 0, 'interview_status' => 1]);
        if($row)
        {
            $finalFeedback->update(['active' => 0]);
            return ['success' => true];
        }
         else
        {
            return ['success' => false];
        }
    }

    public function sendNotificationForSchedule($scheduleId,$user)
    {
        
            $scheduledId = InterviewSchedule::find($scheduleId);
            if ($scheduledId) {
                $notificationRepo = new NotificationRepository();
                $notificationData = [];
                $notificationData['view_url'] = action('FinalRoundController@store', ['id' => $scheduledId->id]);
                $notificationData['interview_schedule_id'] = $scheduledId->id;
                if ($user) {
                    $name = $user->name;
                    $notificationData['user_id'] = $user->id;
                }
                $notificationData['text'] = $name . ' Final Round Schedule Interview.';
                $notificationRepo->insert($notificationData);
            }
 
    }

    public function sendNotificationForFinalFeedBack($feedBackId,$user)
    {
       
            $finalFeedBackId = InterviewFeedback::find($feedBackId);
            if ($finalFeedBackId) {
                $notificationRepo = new NotificationRepository();
                $notificationData = [];
                $notificationData['view_url'] = action('FinalRoundController@finalRoundFeedbackStore', ['id' => $finalFeedBackId->id]);
                $notificationData['interview_schedule_id'] = $finalFeedBackId->id;
                if ($user) {
                    $name = $user->name;
                    $notificationData['user_id'] = $user->id;
                }
                $notificationData['text'] = $name . ' Final Round Interview FeedBack.';
                $notificationRepo->insert($notificationData);
            }
 
    }

}