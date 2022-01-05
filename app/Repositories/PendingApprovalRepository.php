<?php


namespace App\Repositories;

use App\Skill;
use App\LeaveApplication;
use App\LeavesBank;
use App\TeamMember;
use App\EmployeesExtraAndHalfDayLeavesDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use DateTime;
use DatePeriod;
use DateInterval;


class PendingApprovalRepository
{
    public function fetchAppliedLeave()
    {
        $appliedLeave = TeamMember::orderBy('team_members.created_at', 'ASC')
        ->leftJoin('leave_applications','leave_applications.user_id','=','team_members.members')
        ->leftJoin('users','users.id','=','team_members.members')
        ->Where('leave_applications.status','=',0)
    // ->Where('team_members.user_id','=',3)
        ->get(['leave_applications.id','users.id as usersId','users.name','leave_applications.application_type','leave_applications.from_date','leave_applications.to_date','leave_applications.reason']);
        
        return $appliedLeave;
    }

    public function approveAndRejectedStatus($btnId,$leaveApplicationId,$leaveApplicationType,$fromDate,$toDate,$userId)
    {
       if($leaveApplicationType == 1 && $btnId != 2){

            $totalLeaveBank = LeavesBank::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->whereMonth('date','=',date('m'))
            ->get(['number_of_leaves']);
            
            $totalAddLeave = EmployeesExtraAndHalfDayLeavesDetail::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->whereMonth('created_at','=',date('m'))
            ->sum('extra_leaves');
            
            $totalLeave = LeaveApplication::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->where('application_type','=',1)
            ->where('id','=',$leaveApplicationId)
            ->whereMonth('created_at','=',date('m'))
            ->whereBetween('from_date',[$fromDate,$toDate])
            ->get(['from_date','to_date']);
            $begin = new DateTime($totalLeave[0]->from_date);
            $end = new DateTime($totalLeave[0]->to_date);
            $end = $end->modify( '+1 day' );
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($begin, $interval ,$end);
            $days=[];
            foreach ($dateRange as $key => $value) {
                    $days[] = $value->format('Y-m-d');      
                }
            $total_days_leaves = count($days);


            $totalHalfDayLeave = EmployeesExtraAndHalfDayLeavesDetail::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->whereMonth('created_at','=',date('m'))
            ->sum('half_day_leaves');
            
           $checkLeaves = abs((int)$totalAddLeave - (int)$total_days_leaves - (int)$totalHalfDayLeave);
            for($i=1;$i<=$checkLeaves;$i++){
                if($totalLeaveBank[0]->number_of_leaves >= $i){
                    $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$leaveApplicationId)
                    ->update(['status' => $btnId]);
                        $employee_full_leave['user_id'] = $userId;
                        $employee_full_leave['leave_id'] = $leaveApplicationId;
                        $employee_full_leave['apply_date'] = date("Y-m-d");
                        $employee_full_leave['leaves'] = 1;
                        $employee_full_leave['narration'] = $leaveApplicationType;
                        $row = EmployeesExtraAndHalfDayLeavesDetail::create($employee_full_leave);
                }else{
                    return ['success' => true,'status' => $btnId];
                }
          }
            $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$leaveApplicationId)
            ->update(['status' => $btnId]);
            return ['success' => true,'status' => $btnId];
       }elseif($leaveApplicationType == 2 && $btnId != 2){
            $totalLeaveBank = LeavesBank::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->get(['number_of_leaves']);

            
            $totalAddLeave = EmployeesExtraAndHalfDayLeavesDetail::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->whereMonth('created_at','=',date('m'))
            ->sum('extra_leaves');
            
            $totalLeave = LeaveApplication::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->where('application_type','=',1)
            ->whereMonth('created_at','=',date('m'))
            ->get()->count();
            
           
            $totalHalfDayLeave = EmployeesExtraAndHalfDayLeavesDetail::orderBy('created_at', 'DESC')
            ->where('user_id','=',$userId)
            ->whereMonth('created_at','=',date('m'))
            ->sum('half_day_leaves');

            $checkRemainingLeaves = abs($totalAddLeave - $totalLeave - $totalHalfDayLeave);
            if($totalLeaveBank[0]->number_of_leaves >= $checkRemainingLeaves){
                    $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$leaveApplicationId)
                    ->update(['status' => $btnId]);
                        $employee_full_leave['user_id'] = $userId;
                        $employee_full_leave['leave_id'] = $leaveApplicationId;
                        $employee_full_leave['apply_date'] = date("Y-m-d");
                        $employee_full_leave['half_day_leaves'] = 1;
                        $employee_full_leave['narration'] = $leaveApplicationType;
                        $row = EmployeesExtraAndHalfDayLeavesDetail::create($employee_full_leave);
                        if($row){
                            return ['success' => true,'status' => $btnId];
                        }
            }else{
                $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$leaveApplicationId)
                ->update(['status' => $btnId]);
                return ['success' => true,'status' => $btnId];
            }
        }elseif($leaveApplicationType == 3 && $btnId != 2){
                $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$leaveApplicationId)
                ->update(['status' => $btnId]);
                    $employee_full_leave['user_id'] = $userId;
                    $employee_full_leave['leave_id'] = $leaveApplicationId;
                    $employee_full_leave['apply_date'] = date("Y-m-d");
                    $employee_full_leave['extra_leaves'] = 1;
                    $employee_full_leave['narration'] = $leaveApplicationType;
                    $row = EmployeesExtraAndHalfDayLeavesDetail::create($employee_full_leave);
                    if($row){
                        return ['success' => true,'status' => $btnId];
                    }
        }elseif($leaveApplicationType == 4 || $leaveApplicationType == 5){
            $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$leaveApplicationId)
            ->update(['status' => $btnId]);
            return ['success' => true,'status' => $btnId];

        }else{
            if($btnId == 2){
                $changeLeaveApplictionStatus = LeaveApplication::where('id','=',$leaveApplicationId)
                ->update(['status' => $btnId]);
                return ['success' => true,'status' => $btnId];
            }
        }
    }
}