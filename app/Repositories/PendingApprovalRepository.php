<?php


namespace App\Repositories;

use App\Skill;
use App\LeaveApplication;
use App\TeamMember;
use App\EmployeesExtraAndHalfDayLeavesDetail;
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
            if($changeLeaveApplictionStatus && $btnid != 2){
                $Leaves = LeaveApplication::orderBy('created_at', 'DESC')
                ->where('leave_applications.id','=',$statusId)
                ->get(['id','user_id','from_date','application_type']);
                
                if($Leaves[0]->application_type == 1){
                    $employee_full_leave['user_id'] = $Leaves[0]->user_id;
                    $employee_full_leave['leave_id'] = $Leaves[0]->id;
                    $employee_full_leave['apply_date'] = $Leaves[0]->from_date;
                    $employee_full_leave['leaves'] = 1;
                    $employee_full_leave['narration'] = $Leaves[0]->application_type;
                    $row = EmployeesExtraAndHalfDayLeavesDetail::create($employee_full_leave);
                    if($row){
                        return ['success' => true,'status' => $btnid];
                    }
                }elseif($Leaves[0]->application_type == 2){
                    $employee_full_leave['user_id'] = $Leaves[0]->user_id;
                    $employee_full_leave['leave_id'] = $Leaves[0]->id;
                    $employee_full_leave['apply_date'] = $Leaves[0]->from_date;
                    $employee_full_leave['half_day_leaves'] = 1;
                    $employee_full_leave['narration'] = $Leaves[0]->application_type;
                    $row = EmployeesExtraAndHalfDayLeavesDetail::create($employee_full_leave);
                    if($row){
                        return ['success' => true,'status' => $btnid];
                    }
                }elseif($Leaves[0]->application_type == 3){
                    $employee_full_leave['user_id'] = $Leaves[0]->user_id;
                    $employee_full_leave['leave_id'] = $Leaves[0]->id;
                    $employee_full_leave['apply_date'] = $Leaves[0]->from_date;
                    $employee_full_leave['extra_leaves'] = 1;
                    $employee_full_leave['narration'] = $Leaves[0]->application_type;
                    $row = EmployeesExtraAndHalfDayLeavesDetail::create($employee_full_leave);
                    if($row){
                        return ['success' => true,'status' => $btnid];
                    }
                }else{
                    
                    return ['success' => true,'status' => $btnid];
                }
            }else{
                return ['success' => true,'status' => $btnid];
            }
            //return ['success' => true,'status' => $btnid];

    }
}