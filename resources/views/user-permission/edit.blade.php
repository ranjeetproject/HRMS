@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Users Permission Edit</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-person-booth"></i> Users Permission Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fas fa-plus-square"></i>
                                    Users Permission Edit
                                </div>
                            </div>
                            <form action="{{action('UserPermissionController@update',[$permission['module']->id])}}" method="post"
                                  enctype="multipart/form-data" id="skillForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="department_id">Department</label>
                                            <div class="col-md-4">
                                                <select
                                                    class="form-control custom-select {{ $errors->has('department_id') ? 'is-invalid' : '' }}"
                                                    name="department_id" id="department_id" disabled>
                                                    <option value="">Select</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{$department->id}}" @if(@$permission['user_permission']->department_id==$department->id) selected @endIf>{{$department->department_name}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_department_id">{{ $errors->getBag('default')->first('department_id') }}</span>
                                            </div>
                                            <label class="col-md-2 form-control-label" for="designation_id">Designation </label>
                                            <div class="col-md-4">
                                               <select
                                                    class="form-control custom-select {{ $errors->has('designation_id') ? 'is-invalid' : '' }}"
                                                    name="designation_id" id="designation_id" disabled>
                                                    <option value="">Select</option>
                                                     @foreach ($designations as $designation)
                                                        <option value="{{$designation->id}}" @if(@$permission['user_permission']->designation_id==$designation->id) selected @endIf>{{$designation->designation_name}}</option>
                                                       @endforeach
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_designation_id">{{ $errors->getBag('default')->first('designation_id') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="skills_table">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>Modules</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> HR </label>
                                                    <input type="checkbox" class="form-check-input" name="hr_module" id="hr" value="hr" @if(@$permission['module']->hr_module == 'hr') {{'checked'}} @endIf style="margin-left:60%">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> Statutory Master </label>
                                                    <input type="checkbox" class="form-check-input" name="statutory_master" id="sm" value="sm"  @if(@$permission['module']->statutory_master == 'sm') {{'checked'}} @endIf style="margin-left:60%" >
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> Super User </label>
                                                    <input type="checkbox" class="form-check-input" name="super_user" id="su" value="su"  @if(@$permission['module']->super_user == 'su') {{'checked'}} @endIf style="margin-left:60%" >
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> General </label>
                                                    <input type="checkbox" class="form-check-input" name="general" id="gr" value="gr" @if(@$permission['module']->general == 'gr') {{'checked'}} @endIf style="margin-left:60%" >
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> Manager </label>
                                                    <input type="checkbox" class="form-check-input" name="manager" id="mg" value="mg" @if(@$permission['module']->manager == 'mg') {{'checked'}} @endIf style="margin-left:60%" >
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="skills_table">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>Action</th>
                                                    <th>Modules</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="recruitment_view" id="skill" value="1" @if(@$permission['user_permission']->recruitment_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="recruitment_modify" id="skill" value="2"  @if(@$permission['user_permission']->recruitment_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Recruitment</th>
                                                </tr>
                                                 <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="holiday_view" id="skill" value="1" @if(@$permission['user_permission']->holiday_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="holiday_modify" id="skill" value="2" @if(@$permission['user_permission']->holiday_modify == 2) {{'checked'}} @endIf  style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Holiday</th>
                                                </tr>
                                                 <tr class="m">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input m1" name="performance_view" id="skill" value="1" @if(@$permission['user_permission']->performance_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input m1" name="performance_modify" id="skill" value="2" @if(@$$permission['user_permission']->performance_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Performance Feedback</th>
                                                </tr>
                                                <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="add_skills_view" id="skill" value="1" @if(@$permission['user_permission']->add_skills_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="add_skills_modify" id="skill" value="2" @if(@$permission['user_permission']->add_skills_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Add Skills</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="final_round_list_view" id="skill" value="1" @if(@$permission['user_permission']->final_round_list_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="final_round_list_modify" id="skill" value="2" @if(@$permission['user_permission']->final_round_list_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Final Round List</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="offered_candidate_list_view" id="skill" value="1" @if(@$permission['user_permission']->offered_candidate_list_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="offered_candidate_list_modify" id="skill" value="2"  @if(@$permission['user_permission']->offered_candidate_list_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Offered Candidate List</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="current_employee_view" id="skill" value="1" @if(@$permission['user_permission']->current_employee_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="current_employee_modify" id="skill" value="2" @if(@$permission['user_permission']->current_employee_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Current Employee</th>
                                                </tr>
                                                <tr class="sp">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input sp1" name="user_log_view" id="skill" value="1" @if(@$permission['user_permission']->user_log_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                    </th>
                                                    <th>User Log</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="salary_set_up_view" id="skill" value="1" @if(@$permission['user_permission']->salary_set_up_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="salary_set_up_modify" id="skill" value="2" @if(@$permission['user_permission']->salary_set_up_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Salary Set Up</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="released_employees_view" id="skill" value="1" @if(@$permission['user_permission']->released_employees_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="released_employees_modify" id="skill" value="2" @if(@$permission['user_permission']->released_employees_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Released Employees</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="interview_feedback_content_view" id="skill" value="1" @if(@$permission['user_permission']->interview_feedback_content_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="interview_feedback_content_modify" id="skill" value="2" @if(@$permission['user_permission']->interview_feedback_content_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Interview Feedback Content</th>
                                                </tr>
                                                <tr class="r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="rejected_view" id="skill" value="1" @if(@$permission['user_permission']->rejected_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                    </th>
                                                    <th>Rejected List</th>
                                                </tr>
                                                <tr class="g">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input g1" name="leave_application_view" id="skill" value="1" @if(@$permission['user_permission']->leave_application_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input g1" name="leave_application_modify" id="skill" value="2"  @if(@$permission['user_permission']->leave_application_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Leave Application</th>
                                                </tr>
                                                <tr class="g">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                        <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                        <input type="checkbox" class="form-check-input g1" name="pending_approve_leave_view" id="skill" value="1" @if(@$permission['user_permission']->pending_approve_leave_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                    </th>
                                                    <th>Pending Approved Leaves</th>
                                                </tr>
                                                <tr class="m">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input m1" name="team_member_view" id="skill" value="1" @if(@$permission['user_permission']->team_member_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input m1" name="team_member_modify" id="skill" value="2" @if(@$permission['user_permission']->team_member_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Team Member</th>
                                                </tr>
                                                <tr class="g">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input g1" name="skill_acquired_view" id="skill" value="1" @if(@$permission['user_permission']->skill_acquired_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input g1" name="skill_acquired_modify" id="skill" value="2"  @if(@$permission['user_permission']->skill_acquired_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Skill Acquired</th>
                                                </tr>
                                                <tr class="m">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input m1" name="approved_skills_view" id="skill" value="1" @if(@$permission['user_permission']->approved_skills_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input m1" name="approved_skills_modify" id="skill" value="2" @if(@$permission['user_permission']->approved_skills_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Approved Skills</th>
                                                </tr>
                                                <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="designation_view" id="skill" value="1" @if(@$permission['user_permission']->designation_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="designation_modify" id="skill" value="2" @if(@$permission['user_permission']->designation_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Designation</th>
                                                </tr>
                                                <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="department_view" id="skill" value="1" @if(@$permission['user_permission']->department_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="department_modify" id="skill" value="2" @if(@$permission['user_permission']->department_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Department</th>
                                                </tr>
                                                <tr class="sp">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input sp1" name="user_permission_view" id="skill" value="1" @if(@$permission['user_permission']->user_permission_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input sp1" name="user_permission_modify" id="skill" value="2" @if(@$permission['user_permission']->user_permission_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>User Permission</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary"> Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
         
        </div>
    </div>
@endsection
@section('customJsInclude')
    <script type="text/javascript">
        var baseUrl = '{{asset('/')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

             $("#hr").change(function() {
                if($(this).prop('checked')) {
                    $(".r").show();
                } else {
                    $(".r").hide();
                    $(".r1").prop('checked',false);
                }
            });
            $("#sm").change(function() {
                if($(this).prop('checked')) {
                    $(".s").show();
                } else {
                    $(".s").hide();
                    $(".s1").prop('checked',false);
                }
            });
            $("#su").change(function() {
                if($(this).prop('checked')) {
                    $(".sp").show();
                } else {
                    $(".sp").hide();
                    $(".sp1").prop('checked',false);
                }
            });
            $("#gr").change(function() {
                if($(this).prop('checked')) {
                    $(".g").show();
                } else {
                    $(".g").hide();
                    $(".g1").prop('checked',false);
                }
            });
             $("#mg").change(function() {
                if($(this).prop('checked')) {
                    $(".m").show();
                } else {
                    $(".m").hide();
                    $(".m1").prop('checked',false);
                }
            });
            if($("#sm").prop('checked')) {
                $(".s").show();
            }else {
                $(".s").hide();
            } 
            if($("#hr").prop('checked')) {
                $(".r").show();
            }else {
                $(".r").hide();
            } 
            if($("#su").prop('checked')) {
                $(".sp").show();
            }else {
                $(".sp").hide();
            }
            if($("#gr").prop('checked')) {
                $(".g").show();
            }else {
                $(".g").hide();
            }
            if($("#mg").prop('checked')) {
                $(".m").show();
            }else {
                $(".m").hide();
            }

            $('#skillForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
       


    </script>
@endsection