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
        ->whereNotIn('id', DB::table('team_members')->pluck('members'))
        ->where('id','!=',$user->id)->get(['id','name']);
        return $users;
    }

    public function allSelected($user)
    {
        $selectUsers = TeamMember::orderBy('created_at', 'DESC')
        ->where('user_id', '=' ,$user->id)->get();
        return $selectUsers;
    }

    public function allMember(){

        $users = User::orderBy('created_at', 'DESC')
        ->where('id','!=',1)
        ->get(['id']);
        return $users;
    }

    public function insert($inputData,$user)
    {
        
        if($inputData)
        {
            foreach($inputData['team'] as $val){
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

    public function updateSave($inputData, $id,$user)
    {
        
        $member = TeamMember::where('user_id','=',$id)->pluck('members')->toArray();
       
        if($member){
            if($inputData['team'] == null){
                TeamMember::where('user_id','=',$id)->whereIn('members',$member)->delete();
                return ['success' => true];
            }
            foreach($inputData['team']  as $val){
                if(!in_array($val,$member))
                {
                    TeamMember::create([
                            'user_id'=> $id,
                            'members'=> $val, 
                            ]);
                }
                    
            }
            $oldMember = array_diff($member,$inputData['team']);
            if(count($oldMember) > 0)
            {
                TeamMember::where('user_id','=',$id)->whereIn('members',$oldMember)->delete();
            }
            return ['success' => true];
        }else{
            return ['success' => false];
        }
       
    }
}