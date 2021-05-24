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
                            <form action="{{action('UserPermissionController@update',[$permission->id])}}" method="post"
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
                                                        <option value="{{$department->id}}" @if(@$permission->department_id==$department->id) selected @endIf>{{$department->department_name}}</option>
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
                                                        <option value="{{$designation->id}}" @if(@$permission->designation_id==$designation->id) selected @endIf>{{$designation->designation_name}}</option>
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
                                                    <th>Action</th>
                                                    <th>Modules</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="recruitment_view" id="skill" value="1" @if(@$permission->recruitment_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="recruitment_modify" id="skill" value="2"  @if(@$permission->recruitment_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Recruitment</th>
                                                </tr>
                                                 <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="holiday_view" id="skill" value="1" @if(@$permission->holiday_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="holiday_modify" id="skill" value="2" @if(@$permission->holiday_modify == 2) {{'checked'}} @endIf  style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Holiday</th>
                                                </tr>
                                                 <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="performance_view" id="skill" value="1" @if(@$permission->performance_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="performance_modify" id="skill" value="2" @if(@$permission->performance_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Performance Feedback</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="add_skills_view" id="skill" value="1" @if(@$permission->add_skills_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="add_skills_modify" id="skill" value="2" @if(@$permission->add_skills_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Add Skills</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="final_round_list_view" id="skill" value="1" @if(@$permission->final_round_list_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="final_round_list_modify" id="skill" value="2" @if(@$permission->final_round_list_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Final Round List</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="offered_candidate_list_view" id="skill" value="1" @if(@$permission->offered_candidate_list_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="offered_candidate_list_modify" id="skill" value="2"  @if(@$permission->offered_candidate_list_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Offered Candidate List</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="current_employee_view" id="skill" value="1" @if(@$permission->current_employee_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="current_employee_modify" id="skill" value="2" @if(@$permission->current_employee_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Current Employee</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="user_log_view" id="skill" value="1" @if(@$permission->user_log_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                    </th>
                                                    <th>User Log</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="salary_set_up_view" id="skill" value="1" @if(@$permission->salary_set_up_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="salary_set_up_modify" id="skill" value="2" @if(@$permission->salary_set_up_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Salary Set Up</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="released_employees_view" id="skill" value="1" @if(@$permission->released_employees_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="released_employees_modify" id="skill" value="2" @if(@$permission->released_employees_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Released Employees</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="leave_application_view" id="skill" value="1" @if(@$permission->leave_application_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="leave_application_modify" id="skill" value="2"  @if(@$permission->leave_application_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Leave Application</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="team_member_view" id="skill" value="1" @if(@$permission->team_member_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="team_member_modify" id="skill" value="2" @if(@$permission->team_member_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Team Member</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="skill_acquired_view" id="skill" value="1" @if(@$permission->skill_acquired_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="skill_acquired_modify" id="skill" value="2"  @if(@$permission->skill_acquired_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Skill Acquired</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="approved_skills_view" id="skill" value="1" @if(@$permission->approved_skills_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="approved_skills_modify" id="skill" value="2" @if(@$permission->approved_skills_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Approved Skills</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="designation_view" id="skill" value="1" @if(@$permission->designation_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="designation_modify" id="skill" value="2" @if(@$permission->designation_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Designation</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="department_view" id="skill" value="1" @if(@$permission->department_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="department_modify" id="skill" value="2" @if(@$permission->department_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Department</th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input" name="user_permission_view" id="skill" value="1" @if(@$permission->user_permission_view == 1) {{'checked'}} @endIf style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%"> Modify </label>
                                                    <input type="checkbox" class="form-check-input" name="user_permission_modify" id="skill" value="2" @if(@$permission->user_permission_modify == 2) {{'checked'}} @endIf style="margin-left:5%">
                                                   
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