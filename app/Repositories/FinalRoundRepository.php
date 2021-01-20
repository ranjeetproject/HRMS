<?php


namespace App\Repositories;

use App\Recruitment;
use App\InterviewSchedule;
use App\InterviewFeedback;
use App\Skill;
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
                ->where('interview_feedback.active','=',1)->get([
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
                </a>';
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
    
    public function fetchFinalRoundSchedule($id){
        $finalRoundSchedule = InterviewSchedule::where('id','=',$id)->first();
        return $finalRoundSchedule;
    }

    public function fetchFinalFeedbackRound($id){
        $finalFeedbackRoundSchedule = InterviewFeedback::find($id);
        return $finalFeedbackRoundSchedule;
    }

    public function insert($inputData)
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

}