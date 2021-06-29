@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Users Permission</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-person-booth"></i> Users Permission</li>
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
                                    Users Permission
                                </div>
                            </div>
                            <form action="{{action('UserPermissionController@store')}}" method="post"
                                  enctype="multipart/form-data" id="skillForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="department_id">Department</label>
                                            <div class="col-md-4">
                                                <select
                                                    class="form-control custom-select {{ $errors->has('department_id') ? 'is-invalid' : '' }}"
                                                    name="department_id" id="department_id">
                                                    <option value="">Select</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_department_id">{{ $errors->getBag('default')->first('department_id') }}</span>
                                            </div>
                                            <label class="col-md-2 form-control-label" for="designation_id">Designation </label>
                                            <div class="col-md-4">
                                               <select
                                                    class="form-control custom-select {{ $errors->has('designation_id') ? 'is-invalid' : '' }}"
                                                    name="designation_id" id="designation_id">
                                                    <option value="">Select</option>
                                                     @foreach ($designations as $designation)
                                                        <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
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
                                                    <input type="checkbox" class="form-check-input" name="hr_module" id="hr" value="hr" style="margin-left:60%">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> Statutory Master </label>
                                                    <input type="checkbox" class="form-check-input" name="statutory_master" id="sm" value="sm" style="margin-left:60%" >
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> Super User </label>
                                                    <input type="checkbox" class="form-check-input" name="super_user" id="su" value="su" style="margin-left:60%" >
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> General </label>
                                                    <input type="checkbox" class="form-check-input" name="general" id="gr" value="gr" style="margin-left:60%" >
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> Manager </label>
                                                    <input type="checkbox" class="form-check-input" name="manager" id="mg" value="mg" style="margin-left:60%" >
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
                                                    <th>Sub Modules</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="recruitment_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="recruitment_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Recruitment</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="final_round_list_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="final_round_list_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Final Round List</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="offered_candidate_list_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="offered_candidate_list_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Offered Candidate List</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="current_employee_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="current_employee_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Current Employee</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="salary_set_up_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="salary_set_up_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Salary Set Up</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="released_employees_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="released_employees_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Released Employees</th>
                                                </tr>
                                                <tr class= "r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="interview_feedback_content_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input r1" name="interview_feedback_content_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Interview Feedback Content</th>
                                                </tr>
                                                <tr class="r">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input r1" name="rejected_view" id="skill" value="1" style="margin-left:3%" >
                                                    </th>
                                                    <th>Rejected List</th>
                                                </tr>
                                                <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="add_skills_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="add_skills_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Add Skills</th>
                                                </tr>
                                                <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="holiday_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="holiday_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Holiday</th>
                                                </tr>
                                                <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="designation_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="designation_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Designation</th>
                                                </tr>
                                                <tr class="s">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input s1" name="department_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input s1" name="department_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Department</th>
                                                </tr>
                                                 <tr class="sp">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input sp1" name="user_permission_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input sp1" name="user_permission_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>User Permission</th>
                                                </tr>
                                                <tr class="sp">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input sp1" name="user_log_view" id="skill" value="1" style="margin-left:3%" >
                                                    </th>
                                                    <th>User Log</th>
                                                </tr>
                                                <tr class="g">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input g1" name="leave_application_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input g1" name="leave_application_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Leave Application</th>
                                                </tr>
                                                <tr class="g">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input g1" name="skill_acquired_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input g1" name="skill_acquired_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Skill Acquired</th>
                                                </tr>
                                                <tr class="m">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input m1" name="performance_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input m1" name="performance_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Performance Feedback</th>
                                                </tr>
                                                
                                                <tr class="m">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input m1" name="team_member_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input m1" name="team_member_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Team Member</th>
                                                </tr>
                                                <tr class="m">
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>
                                                    <label class="col-md-2 form-control-label" for="skill_name"> View </label>
                                                    <input type="checkbox" class="form-check-input m1" name="approved_skills_view" id="skill" value="1" style="margin-left:3%" >
                                                   
                                                    <label class="col-md-2 form-control-label" for="skill_name" style="margin-left:15%;display:inline;"> Modify </label>
                                                    <input type="checkbox" class="form-check-input m1" name="approved_skills_modify" id="skill" value="2" style="margin-left:5%">
                                                   
                                                    </th>
                                                    <th>Approved Skills</th>
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
                                        <button type="submit" class="btn btn-primary"> Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fas fa-align-justify"></i>
                                    Users Permission
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="user_permission_table">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>ID</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>       
                            </div>
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

            table = $('#user_permission_table').DataTable({
                createdRow: function (row, data) {
                    $(row).attr('data-entry-id', data.id);
                },
                processing: false,
                serverSide: true,
                dom: 'lBfrtip<"actions">',
                ajax: {
                    url: baseUrl + 'user-permission',
                    data: function (d) {
                    }
                },
                retrieve: true,
                columnDefs: [
                    {"className": "dt-center", "targets": [0,1,2,3]}
                ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                "aaSorting": [],
                buttons: [],
                orderCellsTop: true,
                fixedHeader: true,
                columns: [
                    /*{data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},*/
                    {data: 'id', name: 'id', orderable: true, searchable: true, visible: false},
                    {data: 'department_name', name: 'department_name', orderable: true},
                    {data: 'designation_name', name: 'designation_name', orderable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: false}
                ]
            });
             
            $('#skillForm').validate({
                rules: {
                    skill_name: {
                        required: true
                    },
                },
                messages: {
                    skill_name: {
                        required: "This skill name field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });
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
             $(".r").hide();
             $(".s").hide();
             $(".sp").hide();
             $(".g").hide();
             $(".m").hide();
            
                  // unchecked
            

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


