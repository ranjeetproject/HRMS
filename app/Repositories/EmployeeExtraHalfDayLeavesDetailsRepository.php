<?php


namespace App\Repositories;

use App\EmployeesExtraAndHalfDayLeavesDetail;
use App\LeaveApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;



class EmployeeExtraHalfDayLeavesDetailsRepository
{
    public function getAll()
    {
        $data = EmployeesExtraAndHalfDayLeavesDetail::orderBy('employees_extra_and_halfday_leaves_details.created_at', 'DESC')
        ->leftJoin('users','users.id','=','employees_extra_and_halfday_leaves_details.user_id')
        ->get([
            'employees_extra_and_halfday_leaves_details.id', 'users.name','employees_extra_and_halfday_leaves_details.apply_date',
            'employees_extra_and_halfday_leaves_details.extra_leaves','employees_extra_and_halfday_leaves_details.leaves',
            'employees_extra_and_halfday_leaves_details.half_day_leaves','employees_extra_and_halfday_leaves_details.narration',
            'employees_extra_and_halfday_leaves_details.leave_id',
            DB::raw('CASE WHEN narration = 0 THEN " "
            WHEN narration = 1 THEN "Full Day Leave" WHEN narration = 2 THEN "Half Day Leave"
            WHEN narration = 3 THEN "Extra Day Worked" END AS narration')
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<form method="POST" action="'.action('EmployeeExrtaHalfDayLeaveDetails@destroy', $row->id).'" accept-charset="UTF-8" style="display: inline-block;"
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

    public function updateSave($id)
    {
        $row = EmployeesExtraAndHalfDayLeavesDetail::find($id);
        if ($row) {
            $Leaves = LeaveApplication::where('id','=',$row->leave_id)
            ->update(['status' => 0]);
            if($Leaves){
                $row->delete();
                return ['success' => true];
            }else{
                return ['success' => false];
            }
        }else{
            return ['success' => false];
        }
    }
}