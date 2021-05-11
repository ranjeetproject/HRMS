@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Current Employee Details Management</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-user-tie"></i>
                                    Current Employee Details</a></li>
                            <li class="breadcrumb-item active"> View</li>
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
                                <h3 class="card-title"><i class="fas fa-eye "></i> View</h3>
                                <a class="btn btn-danger" href="{{action('EmployeeDetailsController@currentEmployeeList')}}" style="float:right">
                                            Back </a>

                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Name of Candidate</th>
                                        <td>{{@$employee_details->recruitment->name_of_candidate}}</td>
                                    </tr>
                                    <tr>
                                        <th>Reporting Head</th>
                                        <td>{{@$employee_details->reporting_head}}</td>
                                    </tr>
                                    <tr>
                                        <th>Emp Code</th>
                                        <td>{{@$employee_details->emp_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Official Email id</th>
                                        <td>{{@$employee_details->offical_email_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td>{{@$employee_details->contact_number}}</td>
                                    </tr>
                                     <tr>
                                        <th>Alternate Number</th>
                                        <td>{{@$employee_details->alternate_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Experience</th>
                                        <td>{{@$employee_details->total_years_experience}} Years {{@$employee_details->total_months_experience}} Months</td>
                                    </tr>
                                    <tr>
                                        <th>Permanent Address</th>
                                        <td>{{@$employee_details->permanent_address}}</td>
                                    </tr>
                                     <tr>
                                        <th>Current Address</th>
                                        <td>{{@$employee_details->current_address}}</td>
                                    </tr>
                                     <tr>
                                        <th>Email ID</th>
                                        <td>{{@$employee_details->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Father Name</th>
                                        <td>{{@$employee_details->father_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Name</th>
                                        <td>{{@$employee_details->mother_name}}</td>
                                    </tr>
                                     <tr>
                                        <th>Highest Qualification</th>
                                        <td>{{@$employee_details->highest_qualification}}</td>
                                    </tr>
                                     <tr>
                                        <th>Date Of Birth</th>
                                        <td>{{@$employee_details->date_of_birth}}</td>
                                    </tr>
                                    <tr>
                                        <th>Date Of Joining</th>
                                        <td>{{@$employee_details->date_of_joining}}</td>
                                    </tr>
                                    <tr>
                                        <th>Marital Status</th>
                                        <td>{{@$employee_details->marital_status}}</td>
                                    </tr>
                                     <tr>
                                        <th>Name Of Spouse</th>
                                        <td>{{@$employee_details->name_of_spouse}}</td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td>{{@$employee_details->department->department_name}}</td>
                                    </tr>
                                     <tr>
                                        <th>Designation</th>
                                        <td>{{@$employee_details->designation->designation_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Notice Period</th>
                                        @if(@$employee_details->status_serving == 1)
                                            <td>Serving</td>
                                        @elseif(@$employee_details->status_serving == 2)
                                            <td>On Notice</td>
                                        @elseif(@$employee_details->status_serving == 3)
                                            <td>Released</td>
                                        @else
                                            <td></td>
                                        @endif

                                    </tr>
                                     <tr>
                                        <th>Period</th>
                                        @if(@$employee_details->status_probation == 1)
                                            <td>On Probation</td>
                                        @elseif(@$employee_details->status_probation == 2)
                                            <td>Confirmed</td>
                                        @else
                                            <td></td>
                                        @endif

                                    </tr>
                                     <tr>
                                        <th>Skill</th>
                                        <td>
                                        @if($employee_details->candidateSkill)
                                            @foreach (@$employee_details->candidateSkill as  $skills)
                                                    {{@$skills->skill->skill_name}},
                                            @endforeach
                                        @endif
                                        <td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection