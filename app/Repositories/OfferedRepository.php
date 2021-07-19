<?php


namespace App\Repositories;

use App\Recruitment;
use App\InterviewSchedule;
use App\InterviewFeedback;
use App\Skill;
use App\CandidateSkill;
use App\Department;
use App\Designation;
use App\FinalRoundInterviewScheduling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class OfferedRepository
{
    public function getAll()
    {
        $data = InterviewFeedback::orderBy('interview_feedback.created_at', 'DESC')
                ->leftJoin('recruitments','recruitments.id','=','interview_feedback.recruitment_id')
                ->where('interview_feedback.offered','=',1)
                ->where('recruitments.status','!=',1)
                ->where('recruitments.status','!=',0)->get([
                    'interview_feedback.id','interview_feedback.date_of_joining','interview_feedback.recruitment_id','recruitments.name_of_candidate','recruitments.mobile_number','recruitments.email_id',

            ]);
    
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<form method="POST" action="' . action('OfferedController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
                onsubmit="return confirm(\'Are you sure want to delete this row?\');"><input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
                        </form>
                        <a href="'.action('EmployeeDetailsController@offerEmployeeDetails',$row->id).'" data-toggle="tooltip" data-placement="top" title="Employee Details" class="btn btn-primary">
                             <i class="fas fa-user-tie"></i>
                        </a>';
                return $html;
            })
            ->editColumn('date_of_joining', function ($row) {
                if ($row->date_of_joining == '1970-01-01') {
                    return null;
                }else{
                    return $row->date_of_joining;
                }
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function fetchDepartments()
    {
        return Department::get([
            'id', 'department_name'
        ]);
    }
    public function fetchDesignations()
    {
        return Designation::get([
            'id', 'designation_name'
        ]);
    }
    public function fetchSkills()
    {
        return Skill::get([
            'id', 'skill_name'
        ]);
    }

    public function deleteSpecific($id)
    {
        $feedback = InterviewFeedback::where('id', '=' ,$id)->first();
        $row = Recruitment::where('id', '=' ,$feedback->recruitment_id)
        ->update(['status' => 1]);
        if($row)
        {
            $feedback->update(['offered' => 0]);
            return ['success' => true];
        }
         else
        {
            return ['success' => false];
        }
    }
}