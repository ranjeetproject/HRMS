<?php


namespace App\Repositories;

use App\Skill;
use App\LeaveApplication;
use App\TeamMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class PendingApprovalRepository
{
    public function fetchAppliedLeave()
    {
        $appliedLeave = TeamMember::orderBy('team_members.created_at', 'ASC')
        ->leftJoin('leave_applications','leave_applications.user_id','=','team_members.members')
        ->leftJoin('users','users.id','=','team_members.members')
        ->Where('leave_applications.status','=',0)
    // ->Where('team_members.user_id','=',3)
        ->get(['leave_applications.id','users.name','leave_applications.application_type','leave_applications.from_date','leave_applications.to_date','leave_applications.reason']);
      
        return $appliedLeave;
    }

    public function approveAndRejectedStatus($btnid,$statusId){
        $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$statusId)
                ->update(['status' => $btnid]);
                return ['success' => true,'status' => $btnid];
    }
}