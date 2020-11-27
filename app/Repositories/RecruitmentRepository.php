<?php


namespace App\Repositories;

use App\Recruitment;
use App\Skill;
use App\CandidateSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class RecruitmentRepository
{

    public function getAll()
    {
        $data = Recruitment::orderBy('created_at', 'DESC')->get([
            'id', 'name_of_candidate','mobile_number','total_years_experience','total_months_experience','address','email_id'
        ]);
        
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>
                <a href="="" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="" accept-charset="UTF-8" style="display: inline-block;"
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


    public function fetchSkills()
    {
        return Skill::get([
            'id', 'skill_name'
        ]);
    }

    public function insert($inputData)
    {
        
        $recruitmentData = [];
        $recruitmentData['name_of_candidate'] = $inputData['name_of_candidate'];
        $recruitmentData['mobile_number'] = $inputData['mobile_number'];
        $recruitmentData['alternate_number'] = $inputData['alternate_number'];
        $recruitmentData['total_years_experience'] = $inputData['total_years_experience'];
        $recruitmentData['total_months_experience'] = $inputData['total_months_experience'];
        $recruitmentData['address'] = $inputData['address'];
        $recruitmentData['relevent_years_experience'] = $inputData['relevent_years_experience'];
        $recruitmentData['relevent_months_experience'] = $inputData['relevent_months_experience'];
        $recruitmentData['email_id'] = $inputData['email_id'];
        $recruitmentData['application_for'] = $inputData['application_for'];
        $recruitmentData['highest_qualification'] = $inputData['highest_qualification'];
        $recruitmentData['current_ctc'] = $inputData['current_ctc'];
        $recruitmentData['expected_ctc'] = $inputData['expected_ctc'];
        $recruitmentData['current_location'] = $inputData['current_location'];
        $recruitmentData['notice_period'] = $inputData['notice_period'];
        $recruitmentData['special_remarks'] = $inputData['special_remarks'];
        $row = Recruitment::create($recruitmentData);
        if ($row && $row->id > 0) {
           foreach($inputData['skill'] as $val){
            $recruitmentSkillData = [];
            $recruitmentSkillData['skill_id'] = $val;
            $recruitmentSkillData['recruitment_id'] = $row->id;
            CandidateSkill::create($recruitmentSkillData);
           } 
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}
