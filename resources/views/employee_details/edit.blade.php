@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>User Details Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-user-tie"></i>
                                    User Details</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                                <h3 class="card-title"><i class="fas fa-align-justify"></i> Edit</h3>
                                <a class="btn btn-danger" href="{{action('EmployeeDetailsController@currentEmployeeList')}}" style="float:right">
                                            Back </a>
                            </div>
                            <form role="form" action="{{action('EmployeeDetailsController@updateEmployeeDetails',[$employee_details->id])}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                             <input
                                                class="form-control"
                                                type="hidden"
                                                name="recruitment_id" id="recruitment_id" value="{{@$employee_details->recruitment->id}}">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate &nbsp;<span style="color:red">*</span></label>
                                                @if(@$employee_details->recruitment->name_of_candidate)
                                                    <input
                                                        class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                        maxlength="191"
                                                        value="{{old('name_of_candidate',@$employee_details->recruitment->name_of_candidate)}}" readonly>
                                                @else
                                                    <input
                                                        class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                        maxlength="191"
                                                        value="{{old('name_of_candidate',@$employee_details->name_of_candidate)}}" readonly>
                                                @endif

                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="reporting_head">Reporting Head &nbsp;<span style="color:red">*</span></label>
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('reporting_head') ? 'is-invalid' : '' }}"
                                                        name="reporting_head" id="reporting_head">
                                                        <option value="">SELECT</option>
                                                        @if($employee_details->reporting_head=='N/A')
                                                            @foreach ($reportingHeads as $reportingHead)
                                                                <option value="{{$reportingHead->id}}" @if(@$employee_details->reporting_head==$reportingHead->id) selected @endIf>{{$reportingHead->name}}</option>
                                                            @endforeach
                                                            <option value="N/A" selected>N/A</option>
                                                            
                                                        @else
                                                            @foreach ($reportingHeads as $reportingHead)
                                                                <option value="{{$reportingHead->id}}" @if(@$employee_details->reporting_head==$reportingHead->id) selected @endIf>{{$reportingHead->name}}</option>
                                                            @endforeach
                                                            <option value="N/A">N/A</option>
                                                        @endif
                                                    </select>
                                                <span class="form-text text-danger"
                                                      id="error_reporting_head">{{ $errors->getBag('default')->first('reporting_head') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="email">Email Id &nbsp;<span style="color:red">*</span></label>
                                                <input
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="email" id="email" placeholder="Please enter email id"
                                                    maxlength="191"
                                                    value="{{old('email', $employee_details->email)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_email">{{ $errors->getBag('default')->first('email') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="emp_code">Emp Code</label>
                                                    <input
                                                        class="form-control {{ $errors->has('emp_code') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="emp_code" id="emp_code" placeholder="Please enter employee code"
                                                        maxlength="191"
                                                        value="{{@$employee_details->emp_code}}" autocomplete="off">
                                                <span class="form-text text-danger"
                                                      id="error_emp_code">{{ $errors->getBag('default')->first('emp_code') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="contact_number">Contact Number &nbsp;<span style="color:red">*</span></label>
                                                <input
                                                    class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="contact_number" id="contact_number" placeholder="Please enter contact number"
                                                    maxlength="191"
                                                    value="{{old('contact_number',$employee_details->contact_number)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_contact_number">{{ $errors->getBag('default')->first('contact_number') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="alternate_number">Alternate Contact Number</label>
                                                @if(@$employee_details->alternate_number)
                                                    <input
                                                        class="form-control {{ $errors->has('alternate_number') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="alternate_number" id="alternate_number" placeholder="Please enter alternate number"
                                                        maxlength="191"
                                                        value="{{old('alternate_number',$employee_details->alternate_number)}}" readonly>
                                                @else  
                                                    <input
                                                        class="form-control {{ $errors->has('alternate_number') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="alternate_number" id="alternate_number" placeholder="Please enter alternate number"
                                                        maxlength="191"
                                                        value="{{old('alternate_number')}}" autocomplete="off">
                                                @endif

                                                <span class="form-text text-danger"
                                                      id="error_alternate_number">{{ $errors->getBag('default')->first('alternate_number') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="permanent_address">Permanent Address</label>
                                               
                                                    <textarea
                                                        class="form-control {{ $errors->has('permanent_address') ? 'is-invalid' : '' }}"
                                                        name="permanent_address" id="permanent_address" placeholder="Please enter permanent address">{{@$employee_details->permanent_address}}</textarea>
                                                <span class="form-text text-danger"
                                                      id="error_permanent_address">{{ $errors->getBag('default')->first('permanent_address') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="current_address">Current Address</label>
                                                    <textarea
                                                        class="form-control {{ $errors->has('current_address') ? 'is-invalid' : '' }}"
                                                        name="current_address" id="current_address" placeholder="Please enter current address">{{@$employee_details->current_address}}</textarea>
                                                <span class="form-text text-danger"
                                                      id="error_current_address">{{ $errors->getBag('default')->first('current_address') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                               <label class="form-control-label" for="offical_email_id">Official Email id &nbsp;<span style="color:red">*</span></label>
                                                <input
                                                    class="form-control {{ $errors->has('offical_email_id') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="offical_email_id" id="offical_email_id" placeholder="Please enter official email id"
                                                    maxlength="191"
                                                    value="{{old('offical_email_id',@$employee_details->offical_email_id)}}">
                                                <span class="form-text text-danger"
                                                      id="error_offical_email_id">{{ $errors->getBag('default')->first('offical_email_id') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="current_address">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="form-check-input" name="" id="filladdress" value="">
                                                    Same As Permanent Address
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="father_name">Father's Name</label>
                                                    <input
                                                        class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="father_name" id="father_name" placeholder="Please enter father name"
                                                        maxlength="191"
                                                        value="{{@$employee_details->father_name}}" autocomplete="off">
                                                <span class="form-text text-danger"
                                                      id="error_father_name">{{ $errors->getBag('default')->first('father_name') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="mother_name">Mother's Name</label>
                                                    <input
                                                        class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="mother_name" id="mother_name" placeholder="Please enter mother name"
                                                        maxlength="191"
                                                        value="{{@$employee_details->mother_name}}" autocomplete="off">
                                                <span class="form-text text-danger"
                                                      id="error_mother_name">{{ $errors->getBag('default')->first('mother_name') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="date_of_birth">Date of Birth</label>
                                                    @if(@$employee_details->date_of_birth == '1970-01-01')
                                                        <input
                                                            class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="date_of_birth" id="date_of_birth" placeholder="Please enter date of birth"
                                                            maxlength="191"
                                                            value="" autocomplete="off">
                                                    @elseif(@$employee_details->date_of_birth)
                                                        <input
                                                            class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="date_of_birth" id="date_of_birth" placeholder="Please enter date of birth"
                                                            maxlength="191"
                                                            value="{{@$employee_details->date_of_birth}}">
                                                    @else
                                                        <input
                                                            class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="date_of_birth" id="date_of_birth" placeholder="Please enter date of birth"
                                                            maxlength="191"
                                                            value="" autocomplete="off">
                                                    @endif

                                                <span class="form-text text-danger"
                                                      id="error_date_of_birth">{{ $errors->getBag('default')->first('date_of_birth') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date_of_joining">Date of Joining &nbsp;<span style="color:red">*</span></label>
                                               @if(@$employee_details->date_of_joining == '1970-01-01')
                                                <input
                                                    class="form-control {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="date_of_joining" id="date_of_joining" placeholder="Please enter date of joining"
                                                    maxlength="191"
                                                    value="" autocomplete="off">
                                                @elseif(@$employee_details->date_of_joining) 
                                                    <input
                                                        class="form-control {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_joining" id="date_of_joining" placeholder="Please enter date of joining"
                                                        maxlength="191"
                                                        value="{{old('date_of_joining',@$employee_details->date_of_joining)}}" readonly>
                                                @else
                                                    <input
                                                    class="form-control {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="date_of_joining" id="date_of_joining" placeholder="Please enter date of joining"
                                                    maxlength="191"
                                                    value="" autocomplete="off">
                                                @endif
                                                <span class="form-text text-danger"
                                                      id="error_date_of_joining">{{ $errors->getBag('default')->first('date_of_joining') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="marital_status">Marital Status</label>
                                                    <select
                                                        class="form-control custom-select {{ $errors->has("marital_status") ? 'is-invalid' : '' }}"
                                                        name="marital_status" id="marital_status">
                                                        <option value="">Select</option>
                                                        <option value="married" @if(@$employee_details->marital_status=='married') selected @endIf>Married</option>
                                                        <option value="unmarried" @if(@$employee_details->marital_status=='unmarried') selected @endIf>Unmarried</option>
                                                    </select>
                                                <span class="form-text text-danger"
                                                      id="error_marital_status">{{ $errors->getBag('default')->first('marital_status') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name_of_spouse">Name of Spouse</label>
                                                    <input
                                                        class="form-control {{ $errors->has('name_of_spouse') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="name_of_spouse" id="name_of_spouse" placeholder="Please enter name of spouse"
                                                        maxlength="191"
                                                        value="{{@$employee_details->name_of_spouse}}" autocomplete="off">
                                                <span class="form-text text-danger"
                                                      id="error_name_of_spouse">{{ $errors->getBag('default')->first('name_of_spouse') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                               <label class="form-control-label" for="total_years_experience">Experience at Joining </label>
                                                @if(@$employee_details->total_years_experience) 
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('total_years_experience') ? 'is-invalid' : '' }}"
                                                        name="total_years_experience" id="total_years_experience" readonly>
                                                        <option value="{{$employee_details->total_years_experience}}">{{$employee_details->total_years_experience}} Years</option>
                                                        
                                                    </select>
                                                @else
                                                   <select
                                                        class="form-control custom-select {{ $errors->has('total_years_experience') ? 'is-invalid' : '' }}"
                                                        name="total_years_experience" id="total_years_experience">
                                                        <option value="">Years</option>
                                                        <option value="0">0 Years</option>
                                                        <option value="1">1 Years</option>
                                                        <option value="2">2 Years</option>
                                                        <option value="3">3 Years</option>
                                                        <option value="4">4 Years</option>
                                                        <option value="5">5 Years</option>  
                                                        <option value="6">6 Years</option>
                                                        <option value="7">7 Years</option>
                                                        <option value="8">8 Years</option>
                                                        <option value="9">9 Years</option>
                                                        <option value="10">10 Years</option>
                                                        <option value="11">11 Years</option>
                                                        <option value="12">12 Years</option>
                                                        <option value="13">13 Years</option>
                                                        <option value="14">14 Years</option>
                                                        <option value="15">15 Years</option>
                                                        <option value="15+">15+ Years</option>
                                                    </select>
                                                @endif    

                                                <span class="form-text text-danger"
                                                      id="error_total_years_experience">{{ $errors->getBag('default')->first('total_years_experience') }}
                                                </span>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group">
                                               <label class="form-control-label" for="total_months_experience">&nbsp;</label>
                                                @if(@$employee_details->total_months_experience)     
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('total_months_experience') ? 'is-invalid' : '' }}"
                                                        name="total_months_experience" id="total_months_experience" readonly>
                                                        <option value="{{$employee_details->total_months_experience}}">{{$employee_details->total_months_experience}} Months</option>
                                                        
                                                    </select>
                                                @else
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('total_months_experience') ? 'is-invalid' : '' }}"
                                                        name="total_months_experience" id="total_months_experience">
                                                        <option value="">Months</option>
                                                        <option value="0">0 Months</option>
                                                        <option value="1">1 Months</option>
                                                        <option value="2">2 Months</option>
                                                        <option value="3">3 Months</option>
                                                        <option value="4">4 Months</option>
                                                        <option value="5">5 Months</option>
                                                        <option value="6">6 Months</option>
                                                        <option value="7">7 Months</option>
                                                        <option value="8">8 Months</option>
                                                        <option value="9">9 Months</option>
                                                        <option value="10">10 Months</option>
                                                        <option value="11">11 Months</option>
                                                    
                                                    </select>
                                                @endif
                                                <span class="form-text text-danger"
                                                      id="error_total_months_experience">{{ $errors->getBag('default')->first('total_months_experience') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="highest_qualification">Highest Education Qualification</label>
                                                    @if(@$employee_details->highest_qualification)
                                                        <input
                                                            class="form-control {{ $errors->has('highest_qualification') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="highest_qualification" id="highest_qualification" placeholder="Please enter highest qualification"
                                                            maxlength="191"
                                                            value="{{old('highest_qualification',$employee_details->highest_qualification)}}" readonly>
                                                    @else
                                                            <input
                                                            class="form-control {{ $errors->has('highest_qualification') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="highest_qualification" id="highest_qualification" placeholder="Please enter highest qualification"
                                                            maxlength="191"
                                                            value="" autocomplete="off">
                                                    @endif
                                                <span class="form-text text-danger"
                                                      id="error_highest_qualification">{{ $errors->getBag('default')->first('highest_qualification') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="department_id">Department &nbsp;<span style="color:red">*</span></label>
                                                <select
                                                    class="form-control custom-select {{ $errors->has('department_id') ? 'is-invalid' : '' }}"
                                                    name="department_id" id="department_id">
                                                    <option value="">Select</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{$department->id}}" @if(@$employee_details->department_id==$department->id) selected @endIf>{{$department->department_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_department_id">{{ $errors->getBag('default')->first('department_id') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="designation_id">Designation &nbsp;<span style="color:red">*</span></label>
                                                <select
                                                    class="form-control custom-select {{ $errors->has('designation_id') ? 'is-invalid' : '' }}"
                                                    name="designation_id" id="designation_id">
                                                    <option value="">Select</option>
                                                    @foreach ($designations as $designation)
                                                        <option value="{{$designation->id}}" @if(@$employee_details->designation_id==$designation->id) selected @endIf>{{$designation->designation_name}}</opt>
                                                    @endforeach
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_designation_id">{{ $errors->getBag('default')->first('designation_id') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="date_of_released">Date of Released</label>
                                                @if($employee_details->date_of_released == '1970-01-01')
                                                    <input
                                                        class="form-control {{ $errors->has('date_of_released') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_released" id="date_of_released" placeholder="Please enter date of released"
                                                        maxlength="191"
                                                        value="" autocomplete="off">
                                                @elseif($employee_details->date_of_released)
                                                        <input
                                                        class="form-control {{ $errors->has('date_of_released') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_released" id="date_of_released" placeholder="Please enter date of released"
                                                        maxlength="191"
                                                        value="{{$employee_details->date_of_released}}" autocomplete="off">
                                                @else 
                                                    <input
                                                        class="form-control {{ $errors->has('date_of_released') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_released" id="date_of_released" placeholder="Please enter date of released"
                                                        maxlength="191"
                                                        value="" autocomplete="off">
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_date_of_released">{{ $errors->getBag('default')->first('date_of_released') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date_of_confirmed">Date of Confirmed</label>
                                                 @if($employee_details->date_of_confirmed == '1970-01-01')
                                                    <input
                                                        class="form-control {{ $errors->has('date_of_confirmed') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_confirmed" id="date_of_confirmed" placeholder="Please enter date of released"
                                                        maxlength="191"
                                                        value="" autocomplete="off">
                                                @elseif($employee_details->date_of_released)
                                                     <input
                                                        class="form-control {{ $errors->has('date_of_confirmed') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_confirmed" id="date_of_confirmed" placeholder="Please enter date of released"
                                                        maxlength="191"
                                                        value="{{$employee_details->date_of_confirmed}}" autocomplete="off">
                                                @else
                                                     <input
                                                        class="form-control {{ $errors->has('date_of_confirmed') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_confirmed" id="date_of_confirmed" placeholder="Please enter date of released"
                                                        maxlength="191"
                                                        value="" autocomplete="off">
                                                @endIf

                                                <span class="form-text text-danger"
                                                      id="error_date_of_confirmed">{{ $errors->getBag('default')->first('date_of_confirmed') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="skill">Skills/Technology</label>
                                                     <ul class="list-group list-group-flush" style="overflow: auto;">
                                                       @foreach($skills as $skill)
                                                            <li class="list-group-item"> <input type="checkbox" class="form-check-input" name="skill[]" id="skill" value="{{$skill->id}}" @if(in_array($skill->id,$skilldata)) {{'checked'}} @endIf>{{$skill->skill_name}}</li>
                                                        @endforeach
                                                    </ul>
                                                <span class="form-text text-danger"
                                                      id="error_skill">{{ $errors->getBag('default')->first('skill') }}
                                                </span>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="form-control-label" for="">On Probation 
                                                    <input type="radio" class="form-check-input" name="status_probation" id="onProbation" value="1"@if(@$employee_details->status_probation=='1') checked @endIf style="margin-left:3%">
                                                </label>
                                                
                                                <span class="form-text text-danger"
                                                      id="error_onProbation">{{ $errors->getBag('default')->first('onProbation') }}
                                                </span>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="form-control-label" for="highest_qualification">Confirmed
                                                    <input type="radio" class="form-check-input" name="status_probation" id="confirmed" value="2" @if(@$employee_details->status_probation=='2') checked @endIf style="margin-left:3%">
                                                </label>
                                                
                                                <span class="form-text text-danger"
                                                      id="error_confirmed">{{ $errors->getBag('default')->first('confirmed') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="form-control-label" for="serving">Serving 
                                                    <input type="radio" class="form-check-input" name="status_serving" id="serving" value="1" @if(@$employee_details->status_serving=='1') checked @endIf style="margin-left:3%">
                                                </label>
                                                
                                                <span class="form-text text-danger"
                                                      id="error_serving">{{ $errors->getBag('default')->first('serving') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="form-control-label" for="on_notice">On Notice
                                                    <input type="radio" class="form-check-input" name="status_serving" id="on_notice" value="2" @if(@$employee_details->status_serving=='2') checked @endIf style="margin-left:3%">
                                                </label>
                                                
                                                <span class="form-text text-danger"
                                                      id="error_on_notice">{{ $errors->getBag('default')->first('on_notice') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="form-control-label" for="released">Released
                                                    <input type="radio" class="form-check-input" name="status_serving" id="released" value="3" @if(@$employee_details->status_serving=='3') checked @endIf style="margin-left:3%">
                                                </label>
                                                
                                                <span class="form-text text-danger"
                                                      id="error_released">{{ $errors->getBag('default')->first('released') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="{{action('EmployeeDetailsController@currentEmployeeList')}}">
                                            Cancel </a>
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
    <script>

        $(function () {
            $("#filladdress").on("click", function(){
                if (this.checked) { 
                        $("#current_address").val($("#permanent_address").val());
                        $("#permanent_address").prop( "readonly", true )
                }
                else {
                    $("#current_address").val('');  
                    $("#permanent_address").prop( "readonly", false )

                }
            });
            $("#date_of_joining").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
            });

            $("#date_of_birth").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
            });
             $("#date_of_released").datepicker({
                 dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
             });
            $("#date_of_confirmed").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
            });
            
            $('#addReqForm').validate({
                rules: {
                    name_of_candidate: {
                        required: true
                    },
                    reporting_head: {
                        required: true,
                    },
                    email: {
                        required: true
                    },
                    contact_number: {
                        required: true
                    },
                    date_of_joining: {
                        required: true
                    },
                    department: {
                        required: true
                    },
                    designation: {
                        required: true
                    },
                    official_email_id:{
                         required: true
                    },
                },
                messages: {
                    name_of_candidate: {
                        required: "This name of candidate field is required.",
                    },
                    reporting_head: {
                        required: "This reporting head field is required.",
                    },
                    email: {
                        required: "This email id field is required.",
                    },
                    contact_number: {
                        required: "This contact number field is required.",
                    },
                    date_of_joining: {
                        required: "This date of joining field is required.",
                    },
                    department: {
                        required:"This department field is required.",
                    },
                    designation: {
                        required:"This designation field is required.",
                    },
                    official_email_id: {
                        required:"This official email id field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger is-invalid"
            });
            $('#addReqForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });
        });
    </script>
@endsection
