<?php


namespace App\Repositories;

use App\Recruitment;
use App\InterviewSchedule;
use App\InterviewFeedback;
use App\Skill;
use App\CandidateSkill;
use App\EmployeeDetails;
use App\SalarySetUp;
use App\FinalRoundInterviewScheduling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class SalarySetUpRepository
{

    public function getAll()
    {
        $data = SalarySetUp::orderBy('salary_set_ups.created_at', 'DESC')
        ->leftJoin('recruitments','recruitments.id','=','salary_set_ups.recruitment_id')
        ->get([
            'recruitments.name_of_candidate','salary_set_ups.id','salary_set_ups.employee_code','salary_set_ups.email_id','salary_set_ups.salary_type','salary_set_ups.gross_salary','salary_set_ups.ctc'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('SalarySetUpController@show', $row->id) .'" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getCurrentEmployee($id)
    {
        $employee = EmployeeDetails::find($id);
        return $employee;
    }
    public function insert($inputData,$user)
    {
        $row = SalarySetUp::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function getCurrentEmployeeSalaryDetails($id)
    {
        $row = SalarySetUp::where('employee_details_id','=',$id)->first();
        return $row;
    }

    public function view($id)
    {
        $row = SalarySetUp::find($id);
        return $row;
    }
}