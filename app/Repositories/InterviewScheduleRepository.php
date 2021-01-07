<?php


namespace App\Repositories;

use App\InterviewSchedule;
use App\Skill;
use App\Recruitment;
use App\CandidateSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class InterviewScheduleRepository
{
    public function insert($inputData)
    {
        $inputData['interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['interview_scheduling_date']));
        $inputData['interview_scheduling_time'] =  Carbon::parse($inputData['interview_scheduling_time'])->format('h:i:s');

        $row = InterviewSchedule::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function viewSchedule($id)
    {
        $schedule = InterviewSchedule::where('recruitment_id',$id)->first();
        $schedule['interview_scheduling_date'] = date('d-m-Y',strtotime($schedule['interview_scheduling_date']));
        return $schedule;

    }
    public function viewRecruitment($id)
    {
        $row = Recruitment::find($id);
        return $row;
    }

    public function updateSave($inputData, $id)
    {
        $inputData['interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['interview_scheduling_date']));
        $inputData['interview_scheduling_time'] =  Carbon::parse($inputData['interview_scheduling_time'])->format('h:i:s');
        $row = InterviewSchedule::find($id);
        if ($row) {
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    
}

