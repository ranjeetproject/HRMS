<?php


namespace App\Repositories;

use App\LeaveApplication;
use App\EmployeeDetails;
use App\User;
use App\TeamMember;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;



class EmployeesLeaveRepository
{
    public function getAll()
    {
        $data = LeaveApplication::orderBy('leave_applications.created_at', 'DESC')
        ->leftJoin('users','users.id','=','leave_applications.user_id')
        ->get([
            'leave_applications.id', 'leave_applications.from_date','leave_applications.to_date','leave_applications.application_type','leave_applications.reason','leave_applications.status',
            'users.name'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '';

                return $html;
            })
            ->editColumn('application_type', function ($row) {
                if ($row->application_type == 1) {
                    return 'Full Day Leave';
                }elseif($row->application_type == 2){
                    return 'Half Day Leave';
                }elseif($row->application_type == 3){
                    return 'Extra Day Worked';
                }elseif($row->application_type == 4){
                    return 'Work From Home';
                }else{
                    return 'Work From Office';
                }
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 0) {
                    return 'Pending';
                }elseif($row->status == 1){
                    return 'Approve';
                }elseif($row->status == 2){
                    return 'Rejected';
                }
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function getAllLeavesDetails()
    {
        
        $data = LeaveApplication::orderBy('leave_applications.created_at', 'DESC')
        ->leftJoin('users as employees','employees.id','=','leave_applications.user_id')
        ->leftJoin('users as manager','manager.id','=','leave_applications.manager_id')
        ->get([
            'leave_applications.id','employees.name as employee_name','manager.name as manager_name','leave_applications.application_type','leave_applications.status','leave_applications.from_date','leave_applications.to_date'
        ]);
        return Datatables::of($data)
       
        ->addColumn('action', function ($row) {
            $html = '';

            return $html;
        })
        ->editColumn('application_type', function ($row) {
            if ($row->application_type == 1) {
                return 'Full Day Leave';
            }elseif($row->application_type == 2){
                return 'Half Day Leave';
            }elseif($row->application_type == 3){
                return 'Extra Day Worked';
            }elseif($row->application_type == 4){
                return 'Work From Home';
            }else{
                return 'Work From Office';
            }
        })
        ->editColumn('status', function ($row) {
            if ($row->status == 0) {
                return 'Pending';
            }elseif($row->status == 1){
                return 'Approve';
            }elseif($row->status == 2){
                return 'Rejected';
            }
        })
        ->setRowId('id')
        ->rawColumns(['action'])
        ->make(true);

    }
}