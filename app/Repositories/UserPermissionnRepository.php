<?php


namespace App\Repositories;

use App\Designation;
use App\Department;
use App\UserPermission;
use App\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class UserPermissionnRepository
{

    public function getAll($input)
    {
        $data = UserPermission::orderBy('user_permissions.created_at', 'DESC')
        ->leftJoin('departments','departments.id','=','user_permissions.department_id')
        ->leftJoin('designations','designations.id','=','user_permissions.designation_id')
        ->get([
            'user_permissions.id', 'designations.designation_name','departments.department_name'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = ' <a href="' . action('UserPermissionController@edit', $row->id) . '" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function fetchDepartment()
    {
       $row = Department::get([
            'id', 'department_name'
        ]);
        return $row;
    }

    public function fetchDesignation()
    {
       $row = Designation::get([
            'id', 'designation_name'
        ]);
        return $row;
    }

    public function insert($inputData)
    {
        $moduleData = [];
        $moduleData['hr_module'] = (isset($inputData['hr_module']))?$inputData['hr_module']:'';
        $moduleData['statutory_master'] = (isset($inputData['statutory_master']))?$inputData['statutory_master']:'';
        $moduleData['super_user'] = (isset($inputData['super_user']))?$inputData['super_user']:'';
        $moduleData['general'] = (isset($inputData['general']))?$inputData['general']:'';
        $moduleData['manager'] = (isset($inputData['manager']))?$inputData['manager']:'';
        $row = Module::create($moduleData);
        if ($row && $row->id > 0) {
            $inputData['module_id'] = $row->id;
            $userPermission = UserPermission::create($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function viewEdit($id)
    {
        $editPermission['module'] = Module::find($id);
        $editPermission['user_permission'] = UserPermission::where('module_id','=',$editPermission['module']->id)->first();
        return $editPermission;
    }

    public function updateSave($inputData, $id)
    {
        $row = Module::find($id);
        if ($row) {
            $moduleData = [];
            $userPermissionModule = [];
            $moduleData['hr_module'] = (isset($inputData['hr_module']))?$inputData['hr_module']:'';
            $moduleData['statutory_master'] = (isset($inputData['statutory_master']))?$inputData['statutory_master']:'';
            $moduleData['super_user'] = (isset($inputData['super_user']))?$inputData['super_user']:'';
            $moduleData['general'] = (isset($inputData['general']))?$inputData['general']:'';
            $moduleData['manager'] = (isset($inputData['manager']))?$inputData['manager']:'';
            if($row->update($moduleData)){
                $userPermissionModule['recruitment_view'] = (isset($inputData['recruitment_view']))?$inputData['recruitment_view']: 0;
                $userPermissionModule['recruitment_modify'] = (isset($inputData['recruitment_modify']))?$inputData['recruitment_modify']: 0;
                $userPermissionModule['holiday_view'] = (isset($inputData['holiday_view']))?$inputData['holiday_view']: 0;
                $userPermissionModule['holiday_modify'] = (isset($inputData['holiday_modify']))?$inputData['holiday_modify']:0;
                $userPermissionModule['performance_view'] = (isset($inputData['performance_view']))?$inputData['performance_view']: 0;   
                $userPermissionModule['performance_modify'] = (isset($inputData['performance_modify']))?$inputData['performance_modify']: 0;
                $userPermissionModule['add_skills_view'] = (isset($inputData['add_skills_view']))?$inputData['add_skills_view']:0;
                $userPermissionModule['add_skills_modify'] = (isset($inputData['add_skills_modify']))?$inputData['add_skills_modify']: 0;
                $userPermissionModule['final_round_list_view'] = (isset($inputData['final_round_list_view']))?$inputData['final_round_list_view']: 0;
                $userPermissionModule['final_round_list_modify'] = (isset($inputData['final_round_list_modify']))?$inputData['final_round_list_modify']: 0;
                $userPermissionModule['offered_candidate_list_view'] = (isset($inputData['offered_candidate_list_view']))?$inputData['offered_candidate_list_view']: 0;
                $userPermissionModule['offered_candidate_list_modify'] = (isset($inputData['offered_candidate_list_modify']))?$inputData['offered_candidate_list_modify']: 0;
                $userPermissionModule['current_employee_view'] = (isset($inputData['current_employee_view']))?$inputData['current_employee_view']: 0;
                $userPermissionModule['current_employee_modify'] = (isset($inputData['current_employee_modify']))?$inputData['current_employee_modify']: 0;
                $userPermissionModule['user_log_view'] = (isset($inputData['user_log_view']))?$inputData['user_log_view']: 0;   
                $userPermissionModule['salary_set_up_view'] = (isset($inputData['salary_set_up_view']))?$inputData['salary_set_up_view']: 0;
                $userPermissionModule['salary_set_up_modify'] = (isset($inputData['salary_set_up_modify']))?$inputData['salary_set_up_modify']: 0;
                $userPermissionModule['released_employees_view'] = (isset($inputData['released_employees_view']))?$inputData['released_employees_view']: 0;
                $userPermissionModule['released_employees_modify'] = (isset($inputData['released_employees_modify']))?$inputData['released_employees_modify']: 0;
                $userPermissionModule['interview_feedback_content_view'] = (isset($inputData['interview_feedback_content_view']))?$inputData['interview_feedback_content_view']: 0;
                $userPermissionModule['interview_feedback_content_modify'] = (isset($inputData['interview_feedback_content_modify']))?$inputData['interview_feedback_content_modify']: 0;
                $userPermissionModule['rejected_view'] = (isset($inputData['rejected_view']))?$inputData['rejected_view']: 0;
                $userPermissionModule['leave_application_view'] = (isset($inputData['leave_application_view']))?$inputData['leave_application_view']: 0;
                $userPermissionModule['leave_application_modify'] = (isset($inputData['leave_application_modify']))?$inputData['leave_application_modify']: 0;
                $userPermissionModule['pending_approve_leave_view'] = (isset($inputData['pending_approve_leave_view']))?$inputData['pending_approve_leave_view']: 0;
                $userPermissionModule['employees_leaves_view'] = (isset($inputData['employees_leaves_view']))?$inputData['employees_leaves_view']: 0;
                $userPermissionModule['employees_leaves_details_view'] = (isset($inputData['employees_leaves_details_view']))?$inputData['employees_leaves_details_view']: 0;
                $userPermissionModule['extra_half_day_leaves_details_view'] = (isset($inputData['extra_half_day_leaves_details_view']))?$inputData['extra_half_day_leaves_details_view']: 0;
                $userPermissionModule['leaves_details_view'] = (isset($inputData['leaves_details_view']))?$inputData['leaves_details_view']: 0;
                $userPermissionModule['add_leaves_bank_view'] = (isset($inputData['add_leaves_bank_view']))?$inputData['add_leaves_bank_view']: 0;
                $userPermissionModule['team_member_view'] = (isset($inputData['team_member_view']))?$inputData['team_member_view']: 0;
                $userPermissionModule['team_member_modify'] = (isset($inputData['team_member_modify']))?$inputData['team_member_modify']: 0;
                $userPermissionModule['skill_acquired_view'] = (isset($inputData['skill_acquired_view']))?$inputData['skill_acquired_view']: 0;
                $userPermissionModule['skill_acquired_modify'] = (isset($inputData['skill_acquired_modify']))?$inputData['skill_acquired_modify']: 0;
                $userPermissionModule['approved_skills_view'] = (isset($inputData['approved_skills_view']))?$inputData['approved_skills_view']: 0;
                $userPermissionModule['approved_skills_modify'] = (isset($inputData['approved_skills_modify']))?$inputData['approved_skills_modify']: 0;   
                $userPermissionModule['designation_view'] = (isset($inputData['designation_view']))?$inputData['designation_view']: 0;
                $userPermissionModule['designation_modify'] = (isset($inputData['designation_modify']))?$inputData['designation_modify']: 0;
                $userPermissionModule['department_view'] = (isset($inputData['department_view']))?$inputData['department_view']: 0;
                $userPermissionModule['department_modify'] = (isset($inputData['department_modify']))?$inputData['department_modify']: 0;
                $userPermissionModule['user_permission_view'] = (isset($inputData['user_permission_view']))?$inputData['user_permission_view']: 0;
                $userPermissionModule['user_permission_modify'] = (isset($inputData['user_permission_modify']))?$inputData['user_permission_modify']: 0;
                UserPermission::where('module_id','=',$row->id)
                ->update($userPermissionModule);
            }
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
    public function checkPermission($user)
    {
        if($user){
            $row = UserPermission::leftJoin('modules','modules.id','=','user_permissions.module_id')
            ->Where('department_id','=',$user->department_id)->Where('designation_id','=',$user->designation_id)->get();
            return $row;
        }
    }

    
}