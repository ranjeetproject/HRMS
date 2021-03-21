<?php


namespace App\Repositories;

use App\Recruitment;
use App\InterviewSchedule;
use App\InterviewFeedback;
use App\Skill;
use App\TeamMember;
use App\User;
use App\CandidateSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;


class TeamMemberRepository
{
    public function allEmployees($user){

        $users = User::orderBy('created_at', 'DESC')
        ->where('id', '!=' ,$user->id)->get(['name']);
        return $users;
    }

    public function allSelected($user)
    {
        $selectUsers = TeamMember::orderBy('created_at', 'DESC')
        ->where('user_id', '=' ,$user->id)->get();
        return $selectUsers;
    }

    public function insert($inputData,$user)
    {
        if($inputData)
        {
            foreach($inputData['team2'] as $val){
                $team_member = [];
                $team_member['user_id'] = $user->id;
                $team_member['members'] = $val;
                TeamMember::create($team_member);
            }
            return ['success' => true];
        }else{
            return ['success' => false];
        }
    }
}