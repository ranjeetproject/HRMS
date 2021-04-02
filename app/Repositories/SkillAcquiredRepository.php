<?php


namespace App\Repositories;

use App\Skill;
use App\CandidateSkill;
use App\SkillsAcquired;
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
        $data = SkillsAcquired::orderBy('skills_acquireds.created_at', 'DESC')
        ->leftJoin('candidate_skills','candidate_skills.skills_acquireds_id','=','skills_acquireds.id')
        ->leftJoin('skills','skills.id','=','candidate_skills.skill_id')
        ->where('skills_acquireds.user_id','=',$user->id)
        ->get(['skills_acquireds.id','skills_acquireds.acquire_date','skills.skill_name','skills_acquireds.user_id']);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('SkillsAcquiredController@approvedSkill', [$row->id]) .'" data-toggle="tooltip"
                data-placement="top" title="approved-skill" class="btn btn-info">
                <i class="fas fa-thumbs-up"></i></a>
                <form method="POST" action="' . action('SkillsAcquiredController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
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
        $row = SkillsAcquired::create([
            'user_id'=> $inputData['user_id'],
            'acquire_date'=> $inputData['acquire_date'], 
        ]);
        
        if ($row && $row->id > 0) {
            foreach($inputData['skill'] as $val){
                $acquiredSkillData = [];
                $acquiredSkillData['skill_id'] = $val;
                $acquiredSkillData['skills_acquireds_id'] = $row->id;
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
            $row = SkillsAcquired::find($id);
            if ($row) {
                CandidateSkill::where('skills_acquireds_id',$row->id)->delete();
                $row->delete();
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }

    public function fetchSkillAcquiredUser($id)
    {
        $skill_acquired  =  SkillsAcquired::orderBy('skills_acquireds.created_at', 'DESC')
        ->leftJoin('candidate_skills','candidate_skills.skills_acquireds_id','=','skills_acquireds.id')
        ->leftJoin('skills','skills.id','=','candidate_skills.skill_id')
        ->where('skills_acquireds.id','=',$id)->get(['skills.skill_name','skills_acquireds.user_id','skills_acquireds.acquire_date']);   
        
        return $skill_acquired;
    }
}