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
        ->leftJoin('employee_details','employee_details.id','=','salary_set_ups.employee_details_id')
        ->get([
            'recruitments.name_of_candidate','employee_details.name_of_candidate as name','salary_set_ups.id','salary_set_ups.employee_code','salary_set_ups.email_id','salary_set_ups.salary_type','salary_set_ups.gross_salary','salary_set_ups.ctc'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('SalarySetUpController@show', $row->id) .'" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>
                <a href="'.action('SalarySetUpController@edit', $row->id) .'" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="' . action('SalarySetUpController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
                onsubmit="return confirm(\'Are you sure want to delete this row?\');"><input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
                        </form>';

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

    public function viewEdit($id)
    {
        $rowEdit = SalarySetUp::find($id);
        return $rowEdit;
    }

    public function updateSave($inputData, $id)
    {
        $row = SalarySetUp::find($id);
        if ($row) {
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id,$user)
    {
        if ($id > 0) {
            $row = SalarySetUp::find($id);
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