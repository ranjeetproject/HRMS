<?php


namespace App\Repositories;

use App\TeamMember;
use App\InterviewFeedbackContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;



class InterviewFeedbackContentRepository
{
    public function insert($inputData)
    {
        $row = InterviewFeedbackContent::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function interview_feedback_content()
    {
        $row = InterviewFeedbackContent::get()->toArray();
        return $row;
    }

    public function updateSave($inputData, $id)
    {
        $row = InterviewFeedbackContent::find($id);
        if ($row) {
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}