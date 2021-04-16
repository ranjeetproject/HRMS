<?php


namespace App\Repositories;

use App\Skill;
use App\CandidateSkill;
use App\SkillsAcquired;
use App\EmployeeDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class SkillAcquiredRepository
{
    public function getAll($input,$user)
    {
        $data = CandidateSkill::orderBy('candidate_skills.created_at', 'DESC')
        ->leftJoin('skills','skills.id','=','candidate_skills.skill_id')
        ->Where('candidate_skills.status','=',0)
        ->orWhere('candidate_skills.status','=',1)
        ->orWhere('candidate_skills.status','=',2)
        ->get(['candidate_skills.id','candidate_skills.acquire_date','skills.skill_name']);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<form method="POST" action="' . action('SkillsAcquiredController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
                onsubmit="return confirm(\'Are you sure want to delete this row?\');"><input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
                        </form> ';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function fetchSkills()
    {
        return Skill::get([
            'id', 'skill_name'
        ]);
    }

    public function insert($inputData)
    {
        $inputData['acquire_date'] = date('Y-m-d',strtotime($inputData['acquire_date']));
        $employee_details = EmployeeDetails::Select('recruitment_id')->Where('id','=',$inputData['employee_details_id'])->first();
        $inputData['recruitment_id'] = $employee_details->recruitment_id;
        if($inputData)
        {
            foreach($inputData['skill'] as $val)
            {
                $acquiredSkillData = [];
                $acquiredSkillData['skill_id'] = $val;
                $acquiredSkillData['recruitment_id'] = $inputData['recruitment_id'];
                $acquiredSkillData['user_id'] = $inputData['user_id'];
                $acquiredSkillData['acquire_date'] = $inputData['acquire_date'];
                $acquiredSkillData['status'] = 0;
                CandidateSkill::create($acquiredSkillData);
            }
             return ['success' => true];
        } else {
            return ['success' => false];
        }
        
    }

    public function deleteSpecific($id)
    {
        if ($id > 0) {
            $row = CandidateSkill::find($id);
            if ($row) {
                $row->delete();
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }

}