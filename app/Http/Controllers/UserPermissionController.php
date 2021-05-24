<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserPermissionnRepository;


class UserPermissionController extends Controller
{
    protected $userPermissionRepository;

    public function __construct(UserPermissionnRepository $userPermissionRepository)
    {
        $this->userPermissionRepository = $userPermissionRepository;
    }

    public function index(Request $request)
    {
        $data['departments'] =  $this->userPermissionRepository->fetchDepartment();
        $data['designations'] =  $this->userPermissionRepository->fetchDesignation();
        $input = $request->all();
        if ($request->ajax()) {
            return $this->userPermissionRepository->getAll($input);
        } else {
            return view('user-permission.index',$data);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
        $input = $request->all();
        $data = $this->userPermissionRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'User Permission is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('UserPermissionController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data['departments']  =  $this->userPermissionRepository->fetchDepartment();
        $data['designations'] =  $this->userPermissionRepository->fetchDesignation();
        $data['permission']   =  $this->userPermissionRepository->viewEdit($id);
        return view('user-permission.edit',$data);
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();
        if(isset($input['recruitment_view'])){
            $input['recruitment_view'] = 1;
        }else{
            $input['recruitment_view'] = 0;
        }
        if(isset($input['recruitment_modify'])){
            $input['recruitment_modify'] = 2;
        }else{
            $input['recruitment_modify'] = 0;
        }
        if(isset($input['holiday_view'])){
            $input['holiday_view'] = 1;
        }else{
            $input['holiday_view'] = 0;
        }
        if(isset($input['holiday_modify'])){
            $input['holiday_modify'] = 2;
        }else{
            $input['holiday_modify'] = 0;
        }
        if(isset($input['performance_view'])){
            $input['performance_view'] = 1;
        }else{
            $input['performance_view'] = 0;
        }
        if(isset($input['performance_modify'])){
            $input['performance_modify'] = 2;
        }else{
            $input['performance_modify'] = 0;
        }
        if(isset($input['add_skills_view'])){
            $input['add_skills_view'] = 1;
        }else{
            $input['add_skills_view'] = 0;
        }
        if(isset($input['add_skills_modify'])){
            $input['add_skills_modify'] = 2;
        }else{
            $input['add_skills_modify'] = 0;
        }
        if(isset($input['final_round_list_view'])){
            $input['final_round_list_view'] = 1;
        }else{
            $input['final_round_list_view'] = 0;
        }
        if(isset($input['final_round_list_modify'])){
            $input['final_round_list_modify'] = 2;
        }else{
            $input['final_round_list_modify'] = 0;
        }
        if(isset($input['offered_candidate_list_view'])){
            $input['offered_candidate_list_view'] = 1;
        }else{
            $input['offered_candidate_list_view'] = 0;
        }
        if(isset($input['offered_candidate_list_modify'])){
            $input['offered_candidate_list_modify'] = 2;
        }else{
            $input['offered_candidate_list_modify'] = 0;
        }
        if(isset($input['current_employee_view'])){
            $input['current_employee_view'] = 1;
        }else{
            $input['current_employee_view'] = 0;
        }
        if(isset($input['current_employee_modify'])){
            $input['current_employee_modify'] = 2;
        }else{
            $input['current_employee_modify'] = 0;
        }
        if(isset($input['user_log_view'])){
            $input['user_log_view'] = 1;
        }else{
            $input['user_log_view'] = 0;
        }
        if(isset($input['salary_set_up_view'])){
            $input['salary_set_up_view'] = 1;
        }else{
            $input['salary_set_up_view'] = 0;
        }
        if(isset($input['salary_set_up_modify'])){
            $input['salary_set_up_modify'] = 2;
        }else{
            $input['salary_set_up_modify'] = 0;
        }
        if(isset($input['released_employees_view'])){
            $input['released_employees_view'] = 1;
        }else{
            $input['released_employees_view'] = 0;
        }
        if(isset($input['released_employees_modify'])){
            $input['released_employees_modify'] = 2;
        }else{
            $input['released_employees_modify'] = 0;
        }
        if(isset($input['leave_application_view'])){
            $input['leave_application_view'] = 1;
        }else{
            $input['leave_application_view'] = 0;
        }
        if(isset($input['leave_application_modify'])){
            $input['leave_application_modify'] = 2;
        }else{
            $input['leave_application_modify'] = 0;
        }
        if(isset($input['team_member_view'])){
            $input['team_member_view'] = 1;
        }else{
            $input['team_member_view'] = 0;
        }
        if(isset($input['team_member_modify'])){
            $input['team_member_modify'] = 2;
        }else{
            $input['team_member_modify'] = 0;
        }
        if(isset($input['skill_acquired_view'])){
            $input['skill_acquired_view'] = 1;
        }else{
            $input['skill_acquired_view'] = 0;
        }
        if(isset($input['skill_acquired_modify'])){
            $input['skill_acquired_modify'] = 2;
        }else{
            $input['skill_acquired_modify'] = 0;
        }
        if(isset($input['approved_skills_view'])){
            $input['approved_skills_view'] = 1;
        }else{
            $input['approved_skills_view'] = 0;
        }
        if(isset($input['approved_skills_modify'])){
            $input['approved_skills_modify'] = 2;
        }else{
            $input['approved_skills_modify'] = 0;
        }
        if(isset($input['designation_view'])){
            $input['designation_view'] = 1;
        }else{
            $input['designation_view'] = 0;
        }
        if(isset($input['designation_modify'])){
            $input['designation_modify'] = 2;
        }else{
            $input['designation_modify'] = 0;
        }
        if(isset($input['department_view'])){
            $input['department_view'] = 1;
        }else{
            $input['department_view'] = 0;
        }
        if(isset($input['department_modify'])){
            $input['department_modify'] = 2;
        }else{
            $input['department_modify'] = 0;
        }
        if(isset($input['user_permission_view'])){
            $input['user_permission_view'] = 1;
        }else{
            $input['user_permission_view'] = 0;
        }
        if(isset($input['user_permission_modify'])){
            $input['user_permission_modify'] = 2;
        }else{
            $input['user_permission_modify'] = 0;
        }
        $data = $this->userPermissionRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'User Permission is successfully update!',
                'alert-type' => 'success'
            );
            return redirect()->action('UserPermissionController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }



}
