<?php


namespace App\Repositories;

use App\TeamMember;
use App\UserPermission;
use App\PerformanceFeedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;



class PerformanceFeedbackRepository
{

    public function getAll()
    {
        $data = PerformanceFeedback::orderBy('performance_feedback.created_at', 'DESC')
        ->leftJoin('users','users.id', '=', 'performance_feedback.team_member_name_id')
        ->get([
            'performance_feedback.id', 'users.name',
            'performance_feedback.review_date','performance_feedback.description',
            DB::raw('CASE WHEN performance_feedback.performance_type = 0 THEN " "
            WHEN performance_feedback.performance_type = 1 THEN "Extraordinary Performance"
            WHEN performance_feedback.performance_type = 2 THEN "Client Testimonials"
            WHEN performance_feedback.performance_type = 3 THEN "Received GEM" 
            WHEN performance_feedback.performance_type = 4 THEN "Poor performance"
            WHEN performance_feedback.performance_type = 5 THEN "Client Escallation" 
            END AS performance_type')
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<form method="POST" action="' . action('PerformanceFeedbackController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
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

    public function fetchTeamMember($user)
    {
        $member = TeamMember::leftJoin('users','users.id','=','team_members.members')
        ->where('user_id','=',$user->id)->get(['users.name','team_members.members']);
        return $member;
    }

    public function insert($inputData)
    {
        $inputData['review_date'] = date('Y-m-d',strtotime($inputData['review_date']));
        $row = PerformanceFeedback::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id)
    {
        if ($id > 0) {
            $row = PerformanceFeedback::find($id);
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

    public function checkPermission($user)
    {
        $row = UserPermission::Where('department_id','=',$user->user_type)->get();
        return $row;
    }
    
}