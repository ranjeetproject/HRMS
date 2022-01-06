<?php


namespace App\Repositories;

namespace App\Repositories;

use App\InterviewSchedule;
use App\LeaveApplication;
use App\User;
use App\Holiday;
use App\Recruitment;
use App\TeamMember;
use App\CandidateSkill;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class LeaveApplicationRepository
{

    public function getAll($input,$user)
    {
        $data = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$user->id)
        ->get([
            'id','from_date','to_date',
            DB::raw('CASE WHEN application_type = 0 THEN " "
            WHEN application_type = 1 THEN "Full Day Leave" WHEN application_type = 2 THEN "Half Day Leave"
            WHEN application_type = 3 THEN "Extra Day Worked" WHEN application_type = 4 THEN "Work From Home" 
            WHEN application_type = 5 THEN "Work From Office" END AS application_type')
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="' . action('LeaveApplicationController@show', $row->id) . '" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>
                <form method="POST" action="' . action('LeaveApplicationController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
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
    public function getTeamHead($details)
    {
        $data = TeamMember::orderBy('created_at', 'DESC')
        ->where('members','=',$details->id)
        ->first(['user_id']);
        return $data;
    }

    public function insert($inputData,$user)
    {
        $inputData['user_id'] = $user->id;
        $inputData['from_date'] = date('Y-m-d',strtotime($inputData['from_date']));
        $inputData['to_date'] = date('Y-m-d',strtotime($inputData['to_date']));
        $row = LeaveApplication::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function view($id)
    {
        $row = LeaveApplication::find($id);
        return $row;
    }

    public function deleteSpecific($id)
    {
        if ($id > 0) {
            $row = LeaveApplication::find($id);
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

    public function employessDetails()
    {
        $users = User::orderBy('created_at', 'DESC')
        ->where('id','!=',1)->get(['id','name']);
        return $users;
    }

    public function TotalWorkDetail()
    {
        $year = date("Y");
        $month = date("m");  
        $d = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $sun = $this->getSundays($year,$month);
        $sat = $this->getSaturday($year,$month);
        $holiday = $this->getHoliday();
        $totalworkday = $d - $sun - $sat - $holiday;
        return $totalworkday;
    }

    public function remainingNotApplicationApplied($id)
    {
        $totalWorkDetail = $this->TotalWorkDetail();
        $totalNumberOfApproveLeaves = $this->TotalNumberOfApproveLeaves($id);
        $totalWfhApplicationApplied = LeaveApplication::where('user_id','=',$id)
        ->where('application_type','=',4)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->get (['application_type'])->count();
        $totalWfoApplicationApplied = LeaveApplication::where('user_id','=',$id)
        ->where('application_type','=',5)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->get (['application_type'])->count();
        $totalApplicationApplied = $totalWfhApplicationApplied + $totalWfoApplicationApplied;
        $remainingNotAppliedGivenMonth = abs($totalWorkDetail - $totalApplicationApplied - $totalNumberOfApproveLeaves);
        return $remainingNotAppliedGivenMonth;

    }

    public function applicationNotApproved($id)
    {
        $totalApplicationNotApproved = LeaveApplication::where('user_id','=',$id)
        ->where('status','=',0)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->get (['status'])->count();
        return $totalApplicationNotApproved;
    }

    public function getSundays($year, $month)
    {
        $results = '';
        $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
        for($i = 1; $i<= $days; $i++){
        $day  = date('Y-m-'.$i);
        $result = date("l", strtotime($day));
            if($result == "Sunday"){
                $results++;
            }
        }
        return $results;
    }
    public function getSaturday($year, $month)
    {
        $results = '';
        $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
        for($i = 1; $i<= $days; $i++){
        $day  = date('Y-m-'.$i);
        $result = date("l", strtotime($day));
            if($result == "Saturday"){
                $results++;
            }
        }
        return $results;
    }
    public function getHoliday()
    {
        $holidaySaturday = $this->getHolidaySaturday();
        $holidaySunday = $this->getHolidaySunday();
        $numberOfHolidays = Holiday::orderBy('created_at', 'DESC')
        ->whereMonth('holiday_date', Carbon::now()->month)
        ->whereYear('holiday_date',Carbon::now()->year)
        ->get()->count();
        
        if(isset($holidaySaturday)||isset($holidaySunday)){
            $data = (int)$numberOfHolidays - (int)$holidaySaturday - (int)$holidaySunday;
        }
        return $data;
    }

    public function getHolidaySaturday()
    {
        $results = '';
        $data = Holiday::orderBy('created_at', 'DESC')
        ->whereMonth('holiday_date', Carbon::now()->month)
        ->whereYear('holiday_date',Carbon::now()->year)
        ->get(['holiday_date']);
        foreach($data as $val){
            $result = date("l", strtotime($val->holiday_date));
            if($result == "Saturday"){
                $results++;
            }
        }
        return $results;
    }
    public function getHolidaySunday()
    {
        $results = '';
        $data = Holiday::orderBy('created_at', 'DESC')
        ->whereMonth('holiday_date', Carbon::now()->month)
        ->whereYear('holiday_date',Carbon::now()->year)
        ->get(['holiday_date']);
        foreach($data as $val){
            $result = date("l", strtotime($val->holiday_date));
            if($result == "Sunday"){
                $results++;
            }
        }
        return $results;
    }


    public function TotalWorkingDaysDetail($id)
    {
        $row = LeaveApplication::where('user_id','=',$id)
        ->where(function ($query) {
            $query->orWhere('application_type','=',4)
                  ->orWhere('application_type', '=', 5);          
        })
        ->where(function ($querySecond) {
            $querySecond->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOffs($id)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',1);          
        })
        ->where(function ($querySecond) {
            $querySecond->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfApproveLeaves($id)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',1);  
            $query->where('status','=',1);          
        })
        ->where(function ($querySecond) {
            $querySecond->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfExtraWorkApprove($id)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',3)
                    ->where('status','=',1);          
        })
        ->where(function ($querySecond) {
            $querySecond->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfHalfDaysWorkApprove($id)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',2)
                    ->where('status','=',1);          
        })
        ->where(function ($querySecond) {
            $querySecond->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfNotApproveLeavesSalaryDeduction($id)
    {
        // $row = LeaveApplication::orderBy('created_at', 'DESC')
        // ->where('user_id','=',$id)
        // ->where(function ($query) {
        //     $query->where('application_type','=',1)
        //             ->where('status','=',1);          
        // })
        // ->where(function ($querySecond) {
        //     $querySecond->whereMonth('created_at', Carbon::now()->month)
        //                 ->whereYear('created_at', Carbon::now()->year);          
        // })
        // ->get()->count();
        $totalNumberOfApproveLeaves = $this->remainingNotApplicationApplied($id);
        $totalApplicationNotApproved = $this->applicationNotApproved($id);
        $row =  abs($totalNumberOfApproveLeaves + $totalApplicationNotApproved);

        return  $row;
    }

    public function yearMonths(){
        $data = array();
        for ($i = 11; $i >= 0; $i--) {
            $month_number = Carbon::today()->subMonth($i);
            $month = Carbon::today()->subMonth($i);
            $year = Carbon::today()->subMonth($i)->format('Y');
            array_push($data, array(
                'month_number' => $month_number->month,
                'month' => $month->shortMonthName,
                'year' => $year
            ));
        }
        return $data;       
    }

    public function TotalWorkDetailSearch($month,$year)
    {
        $year = $year;
        $month = $month; 
        $d = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $sun = $this->getSundaysSearch($year,$month);
        $sat = $this->getSaturdaySearch($year,$month);
        $holiday = $this->getHolidaySearch($year,$month);
        $totalworkday = $d - $sun - $sat - $holiday;
        return $totalworkday;
    }

    public function remainingNotApplicationAppliedSearch($id,$month,$year)
    {
        $totalWorkDetail = $this->TotalWorkDetailSearch($month,$year);
        $totalNumberOfApproveLeaves = $this->TotalNumberOfApproveLeavesSearch($id,$month,$year);
        $totalWfhApplicationApplied = LeaveApplication::where('user_id','=',$id)
        ->where('application_type','=',4)
        ->whereMonth('created_at', '=',$month)
        ->whereYear('created_at', '=',$year)
        ->get (['application_type'])->count();

        $totalWfoApplicationApplied = LeaveApplication::where('user_id','=',$id)
        ->where('application_type','=',5)
        ->whereMonth('created_at', '=',$month)
        ->whereYear('created_at', '=',$year)
        ->get (['application_type'])->count();
        
        $totalApplicationApplied = $totalWfhApplicationApplied + $totalWfoApplicationApplied;
        $remainingNotAppliedGivenMonth = abs($totalWorkDetail - $totalApplicationApplied - $totalNumberOfApproveLeaves);
        return $remainingNotAppliedGivenMonth;

    }

    public function applicationNotApprovedSearch($id,$month,$year)
    {
        $totalApplicationNotApproved = LeaveApplication::where('user_id','=',$id)
        ->where('status','=',0)
        ->whereMonth('created_at', '=',$month)
        ->whereYear('created_at', '=',$year)
        ->get (['status'])->count();
        return $totalApplicationNotApproved;
    }

    public function getSundaysSearch($year, $month)
    {
        $results = '';
        $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
        for($i = 1; $i<= $days; $i++){
            $day  = date($year.'-'.$month.'-'.$i);
            $result = date("l", strtotime($day));
            if($result == "Sunday"){
                $results++;
            }
        }
        return $results;

    }

    function getSaturdaySearch($year, $month)
    {
        $results = '';
        $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
        for($i = 1; $i<= $days; $i++){
        $day  = date($year.'-'.$month.'-'.$i);
        $result = date("l", strtotime($day));
            if($result == "Saturday"){
                $results++;
            }
        }
        return $results;
    }

    function getHolidaySearch($year,$month)
    {
        $holidaySaturday = $this->getHolidaySaturdaySearch($year,$month);
        $holidaySunday = $this->getHolidaySundaySearch($year,$month);
        $numberOfHolidays = Holiday::orderBy('created_at', 'DESC')
        ->whereMonth('holiday_date', '=',$month)
        ->whereYear('holiday_date','=',$year)
        ->get()->count();
        
        if(isset($holidaySaturday)||isset($holidaySunday)){
            $data = (int)$numberOfHolidays - (int)$holidaySaturday - (int)$holidaySunday;
        }
        return $data;
    }

    function getHolidaySaturdaySearch($year,$month)
    {
        $results = '';
        $data = Holiday::orderBy('created_at', 'DESC')
        ->whereMonth('holiday_date', '=',$month)
        ->whereYear('holiday_date','=',$year)
        ->get(['holiday_date']);
        foreach($data as $val){
            $result = date("l", strtotime($val->holiday_date));
            if($result == "Saturday"){
                $results++;
            }
        }
        return $results;
    }
    function getHolidaySundaySearch($year,$month)
    {
        $results = '';
        $data = Holiday::orderBy('created_at', 'DESC')
        ->whereMonth('holiday_date', '=',$month)
        ->whereYear('holiday_date','=',$year)
        ->get(['holiday_date']);
        foreach($data as $val){
            $result = date("l", strtotime($val->holiday_date));
            if($result == "Sunday"){
                $results++;
            }
        }
        return $results;
    }

    public function TotalWorkingDaysDetailSearch($id,$month,$year)
    {
        $row = LeaveApplication::where('user_id','=',$id)
        ->where(function ($query) {
            $query->orWhere('application_type','=',4)
                  ->orWhere('application_type', '=', 5);          
        })
        ->where(function ($querySecond) use($month,$year){
            
            $querySecond->whereMonth('created_at','=',$month)
                        ->whereYear('created_at','=',$year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOffsSearch($id,$month,$year)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',1);          
        })
        ->where(function ($querySecond) use($month,$year) {
            $querySecond->whereMonth('created_at','=',$month)
                        ->whereYear('created_at','=',$year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfApproveLeavesSearch($id,$month,$year)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',1);
            $query->where('status','=',1);          
        })
        ->where(function ($querySecond) use($month,$year){
            $querySecond->whereMonth('created_at','=',$month)
                        ->whereYear('created_at','=',$year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfExtraWorkApproveSearch($id,$month,$year)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',3)
                    ->where('status','=',1);          
        })
        ->where(function ($querySecond) use($month,$year){
            $querySecond->whereMonth('created_at','=',$month)
                        ->whereYear('created_at','=',$year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfHalfDaysWorkApproveSearch($id,$month,$year)
    {
        $row = LeaveApplication::orderBy('created_at', 'DESC')
        ->where('user_id','=',$id)
        ->where(function ($query) {
            $query->where('application_type','=',2)
                    ->where('status','=',1);          
        })
        ->where(function ($querySecond) use($month,$year){
            $querySecond->whereMonth('created_at','=',$month)
                        ->whereYear('created_at','=',$year);          
        })
        ->get()->count();
        return  $row;
    }

    public function TotalNumberOfNotApproveLeavesSalaryDeductionSearch($id,$month,$year)
    {
        // $row = LeaveApplication::orderBy('created_at', 'DESC')
        // ->where('user_id','=',$id)
        // ->where(function ($query) {
        //     $query->where('application_type','=',1)
        //             ->where('status','=',1);          
        // })
        // ->where(function ($querySecond) use($month,$year){
        //     $querySecond->whereMonth('created_at','=',$month)
        //                 ->whereYear('created_at','=',$year);          
        // })
        // ->get()->count();
        $totalNumberOfApproveLeaves = $this->remainingNotApplicationApplied($id);
        $totalApplicationNotApproved = $this->applicationNotApproved($id);
        $row =  abs($totalNumberOfApproveLeaves + $totalApplicationNotApproved);
        return  $row;
    }


}
