@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Recruitment Management</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fa fa-calendar"></i>
                                    Recruitment</a></li>
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
                                <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}" style="float:right">
                                            Back </a>

                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Name of Candidate</th>
                                        <td>{{@$recruitment->name_of_candidate}}</td>
                                    </tr>
                                     <tr>
                                        <th>Mobile Number</th>
                                        <td>{{@$recruitment->mobile_number}}</td>
                                    </tr>
                                     <tr>
                                        <th>Alternate Number</th>
                                        <td>{{@$recruitment->alternate_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Experience</th>
                                        <td>{{@$recruitment->total_years_experience}} Years {{@$recruitment->total_months_experience}} Months</td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Total Months Experience</th>
                                        <td>{{@$recruitment->total_months_experience}} Months</td>
                                    </tr> -->
                                     <tr>
                                        <th>Total Relevent Experience</th>
                                        <td>{{@$recruitment->relevent_years_experience}} Years {{@$recruitment->relevent_months_experience}} Months</td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Relevent Months Experience</th>
                                        <td>{{@$recruitment->relevent_months_experience}} Months</td>
                                    </tr> -->
                                    <tr>
                                        <th>Address</th>
                                        <td>{{@$recruitment->address}}</td>
                                    </tr>
                                     <tr>
                                        <th>Email ID</th>
                                        <td>{{@$recruitment->email_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Application For</th>
                                        <td>{{@$recruitment->application_for}}</td>
                                    </tr>
                                     <tr>
                                        <th>Highest Qualification</th>
                                        <td>{{@$recruitment->highest_qualification}}</td>
                                    </tr>
                                     <tr>
                                        <th>Current CTC</th>
                                        <td>{{@$recruitment->current_ctc}}</td>
                                    </tr>
                                    <tr>
                                        <th>Expected CTC</th>
                                        <td>{{@$recruitment->expected_ctc}}</td>
                                    </tr>
                                    <tr>
                                        <th>Current Location</th>
                                        <td>{{@$recruitment->current_location}}</td>
                                    </tr>
                                     <tr>
                                        <th>Notice Period</th>
                                        <td>{{@$recruitment->notice_period}}</td>
                                    </tr>
                                    <tr>
                                        <th>Special Remarks</th>
                                        <td>{{@$recruitment->special_remarks}}</td>
                                    </tr>
                                    <tr>
                                        <th>Skill</th>
                                        <td>
                                        @if($recruitment->candidateSkill)
                                            @foreach (@$recruitment->candidateSkill as  $skills)
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