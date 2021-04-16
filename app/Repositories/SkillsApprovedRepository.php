<?php


namespace App\Repositories;

use App\Skill;
use App\CandidateSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class SkillsApprovedRepository
{
    public function fetchAquiredSkill()
    {
        $aquiredSkill = CandidateSkill::orderBy('candidate_skills.created_at', 'ASC')
        ->leftJoin('users','users.id','=','candidate_skills.user_id')
        ->leftJoin('skills','skills.id','=','candidate_skills.skill_id')
        ->Where('candidate_skills.status','=',0)->get(['candidate_skills.id','users.name','skills.skill_name','candidate_skills.acquire_date']);
        return $aquiredSkill;
    }

    public function approveAndDisapproveStatus($candidateId,$statusId)
    {
        
        $changeCandidateStatus = CandidateSkill::where('id','=',$candidateId)
                ->update(['status' => $statusId]);
                return ['success' => true,'status' => $statusId];
        
    }
}