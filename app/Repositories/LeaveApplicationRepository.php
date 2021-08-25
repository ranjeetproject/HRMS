<?php


namespace App\Repositories;

namespace App\Repositories;

use App\InterviewSchedule;
use App\LeaveApplication;
use App\Skill;
use App\Recruitment;
use App\TeamMember;
use App\CandidateSkill;
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
            WHEN application_type = 1 THEN "Full Day Leave" WHEN application_type = 2 THEN "Half Day Leave" WHEN application_type = 3 THEN "Extra Day Worked" WHEN application_type = 4 THEN "Work From Home" END AS application_type')
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
}
