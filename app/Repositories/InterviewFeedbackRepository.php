<?php


namespace App\Repositories;

use App\InterviewFeedback;
use App\Skill;
use App\CandidateSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class InterviewFeedbackRepository
{
    public function insert($inputData)
    {
        $inputData['interview_scheduling_date'] = date('Y-m-d',strtotime($inputData['interview_scheduling_date']));
        $inputData['interview_scheduling_time'] =  Carbon::parse($inputData['interview_scheduling_time'])->format('h:i:s');
        $row = InterviewFeedback::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true,'active' => $row->active];
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
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}