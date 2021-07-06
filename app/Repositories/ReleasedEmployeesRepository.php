<?php



namespace App\Repositories;

use App\Recruitment;
use App\User;
use App\InterviewSchedule;
use App\EmployeeDetails;
use App\InterviewFeedback;
use App\Skill;
use App\CandidateSkill;
use App\FinalRoundInterviewScheduling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Mail;



class ReleasedEmployeesRepository
{
    public function getAll()
    {
        $data = EmployeeDetails::orderBy('employee_details.created_at', 'DESC')
        ->leftJoin('recruitments','recruitments.id','=','employee_details.recruitment_id')
        ->where('status_serving','=',3)
        ->get([
            'employee_details.id','employee_details.name_of_candidate as name','recruitments.name_of_candidate','employee_details.contact_number', 'employee_details.offical_email_id','employee_details.date_of_joining','employee_details.date_of_released'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('ReleasedEmployeesController@show',$row->id).'" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>';
                return $html;
            })
            ->editColumn('name_of_candidate', function ($row) {
                if ($row->name_of_candidate) {
                    return $row->name_of_candidate;
                }else{
                    return $row->name;
                }
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function view($id)
    {
        $row = EmployeeDetails::find($id);
        return $row;
    }
}