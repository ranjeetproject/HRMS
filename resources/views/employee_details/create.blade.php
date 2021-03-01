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
                            <li class="breadcrumb-item active">Add</li>
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
                                <h3 class="card-title"><i class="fas fa-align-justify"></i> Create</h3>
                                <a class="btn btn-danger" href="{{action('OfferedController@index')}}" style="float:right">
                                            Back </a>
                            </div>
                            <form role="form" action="{{action('EmployeeDetailsController@storeOfferEmployee')}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input
                                                class="form-control"
                                                type="hidden"
                                                name="recruitment_id" id="recruitment_id" value="{{@$candiateDetails->recruitment->id}}">
                                                <input
                                                class="form-control"
                                                type="hidden"
                                                name="feedback_id" id="feedback_id" value="{{@$candiateDetails->id}}">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate</label>
                                                <input
                                                    class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                    maxlength="191"
                                                    value="{{old('name_of_candidate',$candiateDetails->recruitment->name_of_candidate)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="reporting_head">Reporting Head</label>
                                                 @if(@$userDetails->reporting_head)
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                                        name="user_id" id="user_id" readonly>
                                                        <option value="">SELECT</option>
                                                        <option value="shreya das" @if(@$userDetails->reporting_head=='shreya das') selected @endIf>Shreya Das</option>
                                                        <option value="shadab mullick" @if(@$userDetails->reporting_head=='shadab mullick') selected @endIf>Shadab Mullick</option>
                                                        <option value="tanmay dutta" @if(@$userDetails->reporting_head=='tanmay dutta') selected @endIf>Tanmay Dutta</option>
                                                    </select>
                                                @else
                                                <select
                                                    class="form-control custom-select {{ $errors->has("reporting_head") ? 'is-invalid' : '' }}"
                                                    name="reporting_head" id="reporting_head">
                                                    <option value="">Select</option>
                                                    <option value="shreya das">Shreya Das</option>
                                                    <option value="shadab mullick">Shadab Mullick</option>
                                                    <option value="tanmay dutta">Tanmay Dutta</option>

                                                </select>
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_reporting_head">{{ $errors->getBag('default')->first('reporting_head') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="email">Email Id</label>
                                                <input
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="email" id="email" placeholder="Please enter email id"
                                                    maxlength="191"
                                                    value="{{old('email', $candiateDetails->recruitment->email_id)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_email">{{ $errors->getBag('default')->first('email') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="emp_code">Emp Code</label>
                                                 @if(@$userDetails->emp_code)
                                                    <input
                                                        class="form-control {{ $errors->has('emp_code') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="emp_code" id="emp_code" placeholder="Please enter employee code"
                                                        maxlength="191"
                                                        value="{{@$userDetails->emp_code}}" readonly>
                                                    @else
                                                        <input
                                                        class="form-control {{ $errors->has('emp_code') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="emp_code" id="emp_code" placeholder="Please enter employee code"
                                                        maxlength="191"
                                                        value="{{old('emp_code')}}">
                                                    @endIf
                                                <span class="form-text text-danger"
                                                      id="error_emp_code">{{ $errors->getBag('default')->first('emp_code') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="contact_number">Contact Number</label>
                                                <input
                                                    class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="contact_number" id="contact_number" placeholder="Please enter contact number"
                                                    maxlength="191"
                                                    value="{{old('contact_number',$candiateDetails->recruitment->mobile_number)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_contact_number">{{ $errors->getBag('default')->first('contact_number') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="alternate_number">Alternate Contact Number</label>
                                                <input
                                                    class="form-control {{ $errors->has('alternate_number') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="alternate_number" id="alternate_number" placeholder="Please enter alternate number"
                                                    maxlength="191"
                                                    value="{{old('alternate_number',$candiateDetails->recruitment->alternate_number)}}" readonly>
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
                                               @if(@$userDetails->permanent_address)
                                                    <textarea
                                                        class="form-control {{ $errors->has('permanent_address') ? 'is-invalid' : '' }}"
                                                        name="permanent_address" id="permanent_address" placeholder="Please enter permanent address" readonly>{{@$userDetails->permanent_address}}</textarea>
                                                @else   
                                                    <textarea
                                                        class="form-control {{ $errors->has('permanent_address') ? 'is-invalid' : '' }}"
                                                        name="permanent_address" id="permanent_address" placeholder="Please enter permanent address">{{old('permanent_address')}}</textarea>
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_permanent_address">{{ $errors->getBag('default')->first('permanent_address') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="current_address">Current Address</label>
                                                @if(@$userDetails->current_address)    
                                                    <textarea
                                                        class="form-control {{ $errors->has('current_address') ? 'is-invalid' : '' }}"
                                                        name="current_address" id="current_address" placeholder="Please enter current address" readonly>{{@$userDetails->current_address}}</textarea>
                                                @else 
                                                    <textarea
                                                        class="form-control {{ $errors->has('current_address') ? 'is-invalid' : '' }}"
                                                        name="current_address" id="current_address" placeholder="Please enter current address">{{old('current_address')}}</textarea>
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_current_address">{{ $errors->getBag('default')->first('current_address') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="offical_email_id">Official Email id</label>
                                               @if(@$userDetails->offical_email_id) 
                                                  <input
                                                        class="form-control {{ $errors->has('offical_email_id') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="offical_email_id" id="offical_email_id" placeholder="Please enter offical email id"
                                                        maxlength="191"
                                                        value="{{$userDetails->offical_email_id}}" readonly>
                                                 @else
                                                    <input
                                                            class="form-control {{ $errors->has('offical_email_id') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="offical_email_id" id="offical_email_id" placeholder="Please enter offical email id"
                                                            maxlength="191"
                                                            value="{{old('offical_email_id')}}">
                                                @endIf    
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
                                               @if(@$userDetails->father_name)
                                                    <input
                                                        class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="father_name" id="father_name" placeholder="Please enter father name"
                                                        maxlength="191"
                                                        value="{{@$userDetails->father_name}}" readonly>
                                                @else
                                                    <input
                                                        class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="father_name" id="father_name" placeholder="Please enter father name"
                                                        maxlength="191"
                                                        value="{{old('father_name')}}">
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_father_name">{{ $errors->getBag('default')->first('father_name') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="mother_name">Mother's Name</label>
                                                @if(@$userDetails->mother_name)
                                                    <input
                                                        class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="mother_name" id="mother_name" placeholder="Please enter mother name"
                                                        maxlength="191"
                                                        value="{{@$userDetails->mother_name}}" readonly>
                                                @else
                                                    <input
                                                        class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="mother_name" id="mother_name" placeholder="Please enter mother name"
                                                        maxlength="191"
                                                        value="{{old('mother_name')}}">
                                                @endIf
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
                                               @if(@$userDetails->date_of_birth)
                                                    <input
                                                        class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_birth" id="date_of_birth" placeholder="Please enter date of birth"
                                                        maxlength="191"
                                                        value="{{@$userDetails->date_of_birth}}" readonly>
                                                @else
                                                    <input
                                                        class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="date_of_birth" id="date_of_birth" placeholder="Please enter date of birth"
                                                        maxlength="191"
                                                        value="{{old('date_of_birth')}}">
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_date_of_birth">{{ $errors->getBag('default')->first('date_of_birth') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date_of_joining">Date of Joining</label>
                                                <input
                                                    class="form-control {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="date_of_joining" id="date_of_joining" placeholder="Please enter date of joining"
                                                    maxlength="191"
                                                    value="{{old('date_of_joining',$candiateDetails->date_of_joining)}}" readonly>
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
                                                @if(@$userDetails->marital_status)
                                                    <select
                                                        class="form-control custom-select {{ $errors->has("marital_status") ? 'is-invalid' : '' }}"
                                                        name="marital_status" id="marital_status" readonly>
                                                        <option value="">Select</option>
                                                        <option value="married" @if(@$userDetails->marital_status=='married') selected @endIf>Married</option>
                                                        <option value="unmarried" @if(@$userDetails->marital_status=='unmarried') selected @endIf>Unmarried</option>
                                                    </select>
                                                @else
                                                    <select
                                                        class="form-control custom-select {{ $errors->has("marital_status") ? 'is-invalid' : '' }}"
                                                        name="marital_status" id="marital_status">
                                                        <option value="">Select</option>
                                                        <option value="married">Married</option>
                                                        <option value="unmarried">Unmarried</option>
                                                    </select>
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_marital_status">{{ $errors->getBag('default')->first('marital_status') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name_of_spouse">Name of Spouse</label>
                                                @if(@$userDetails->name_of_spouse)
                                                    <input
                                                        class="form-control {{ $errors->has('name_of_spouse') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="name_of_spouse" id="name_of_spouse" placeholder="Please enter name of spouse"
                                                        maxlength="191"
                                                        value="{{@$userDetails->name_of_spouse}}" readonly>
                                                @else
                                                    <input
                                                        class="form-control {{ $errors->has('name_of_spouse') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="name_of_spouse" id="name_of_spouse" placeholder="Please enter name of spouse"
                                                        maxlength="191"
                                                        value="{{old('name_of_spouse')}}">
                                                @endIf
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
                                                 <select
                                                    class="form-control custom-select {{ $errors->has('total_years_experience') ? 'is-invalid' : '' }}"
                                                    name="total_years_experience" id="total_years_experience" readonly>
                                                    <option value="{{$candiateDetails->recruitment->total_years_experience}}">{{$candiateDetails->recruitment->total_years_experience}} Years</option>
                                                    
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_total_years_experience">{{ $errors->getBag('default')->first('total_years_experience') }}
                                                </span>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group">
                                               <label class="form-control-label" for="total_months_experience">&nbsp;</label>
                                                 <select
                                                    class="form-control custom-select {{ $errors->has('total_months_experience') ? 'is-invalid' : '' }}"
                                                    name="total_months_experience" id="total_months_experience" readonly>
                                                    <option value="{{$candiateDetails->recruitment->total_months_experience}}">{{$candiateDetails->recruitment->total_months_experience}} Months</option>
                                                    
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_total_months_experience">{{ $errors->getBag('default')->first('total_months_experience') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="highest_qualification">Highest Education Qualification</label>
                                                <input
                                                    class="form-control {{ $errors->has('highest_qualification') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="highest_qualification" id="highest_qualification" placeholder="Please enter highest qualification"
                                                    maxlength="191"
                                                    value="{{old('highest_qualification',$candiateDetails->recruitment->highest_qualification)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_highest_qualification">{{ $errors->getBag('default')->first('highest_qualification') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="department">Department</label>
                                            @if(@$userDetails->department)
                                                <select
                                                    class="form-control custom-select {{ $errors->has('department') ? 'is-invalid' : '' }}"
                                                    name="department" id="department" readonly>
                                                    <option value="">Select</option>
                                                    <option value="accounts" @if(@$userDetails->department=='accounts') selected @endIf>Accounts</option>
                                                    <option value="design" @if(@$userDetails->department=='design') selected @endIf>Design</option>
                                                    <option value="coding"  @if(@$userDetails->department=='coding') selected @endIf>Coding</option>
                                                    <option value="hr"  @if(@$userDetails->department=='hr') selected @endIf>HR</option>
                                                </select>
                                            @else
                                                <select
                                                    class="form-control custom-select {{ $errors->has('department') ? 'is-invalid' : '' }}"
                                                    name="department" id="department">
                                                    <option value="">Select</option>
                                                    <option value="accounts">Accounts</option>
                                                    <option value="design">Design</option>
                                                    <option value="coding">Coding</option>
                                                    <option value="hr">HR</option>
                                                </select>
                                            @endif
                                                <span class="form-text text-danger"
                                                      id="error_department">{{ $errors->getBag('default')->first('department') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="designation">Designation</label>
                                            @if(@$userDetails->designation) 
                                                <select
                                                    class="form-control custom-select {{ $errors->has('designation') ? 'is-invalid' : '' }}"
                                                    name="designation" id="designation" readonly>
                                                    <option value="">Select</option>
                                                    <option value="project manager" @if(@$userDetails->designation=='project manager') selected @endIf>Project Manager</option>
                                                    <option value="account manager"  @if(@$userDetails->designation=='account manager') selected @endIf>Account Manager</option>
                                                    <option value="business development manager" @if(@$userDetails->designation=='business development manager') selected @endIf>Business Development Manager</option>
                                                    <option value="manager"  @if(@$userDetails->designation=='manager') selected @endIf>Manager</option>
                                                </select>
                                            @else
                                                <select
                                                    class="form-control custom-select {{ $errors->has('designation') ? 'is-invalid' : '' }}"
                                                    name="designation" id="designation">
                                                    <option value="">Select</option>
                                                    <option value="project manager">Project Manager</option>
                                                    <option value="account manager">Account Manager</option>
                                                    <option value="business development manager">Business Development Manager</option>
                                                    <option value="manager">Manager</option>
                                                </select>
                                            @endif
                                                <span class="form-text text-danger"
                                                      id="error_designation">{{ $errors->getBag('default')->first('designation') }}
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
                                              @if(@$userDetails->status_probation) 
                                                <label class="form-control-label" for="">On Probation 
                                                    <input type="radio" class="form-check-input" name="status_probation" id="onProbation" value="1" @if(@$userDetails->status_probation =='1') checked @endIf style="margin-left:3%">
                                                </label>
                                             @else
                                                <label class="form-control-label" for="">On Probation 
                                                    <input type="radio" class="form-check-input" name="status_probation" id="onProbation" value="1" style="margin-left:3%">
                                                </label>
                                             @endif    
                                                <span class="form-text text-danger"
                                                      id="error_onProbation">{{ $errors->getBag('default')->first('onProbation') }}
                                                </span>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                             <div class="form-group">
                                            @if(@$userDetails->status_probation) 
                                                <label class="form-control-label" for="highest_qualification">Confirmed
                                                    <input type="radio" class="form-check-input" name="status_probation" id="confirmed" value="2" @if(@$userDetails->status_probation =='2') checked @endIf style="margin-left:3%">
                                                </label>
                                            @else
                                                <label class="form-control-label" for="highest_qualification">Confirmed
                                                    <input type="radio" class="form-check-input" name="status_probation" id="confirmed" value="2" style="margin-left:3%">
                                                </label>
                                            @endif    
                                                <span class="form-text text-danger"
                                                      id="error_confirmed">{{ $errors->getBag('default')->first('confirmed') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-2">
                                             <div class="form-group">
                                            @if(@$userDetails->status_serving)
                                                <label class="form-control-label" for="serving">Serving 
                                                    <input type="radio" class="form-check-input" name="status_serving" id="serving" value="1" @if(@$userDetails->status_serving =='1') checked @endIf style="margin-left:3%">
                                                </label>
                                            @else
                                                <label class="form-control-label" for="serving">Serving 
                                                    <input type="radio" class="form-check-input" name="status_serving" id="serving" value="1" style="margin-left:3%">
                                                </label>
                                            @endif     
                                                <span class="form-text text-danger"
                                                      id="error_serving">{{ $errors->getBag('default')->first('serving') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                            @if(@$userDetails->status_serving)
                                                <label class="form-control-label" for="on_notice">On Notice
                                                    <input type="radio" class="form-check-input" name="status_serving" id="on_notice" value="2" @if(@$userDetails->status_serving =='2') checked @endIf style="margin-left:3%">
                                                </label>
                                            @else
                                                <label class="form-control-label" for="on_notice">On Notice
                                                    <input type="radio" class="form-check-input" name="status_serving" id="on_notice" value="2" style="margin-left:3%">
                                                </label> 
                                            @endif   
                                                <span class="form-text text-danger"
                                                      id="error_on_notice">{{ $errors->getBag('default')->first('on_notice') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                            @if(@$userDetails->status_serving)
                                                <label class="form-control-label" for="released">Released
                                                    <input type="radio" class="form-check-input" name="status_serving" id="released" value="3" @if(@$userDetails->status_serving =='3') checked @endIf style="margin-left:3%">
                                                </label>
                                            @else
                                                <label class="form-control-label" for="released">Released
                                                    <input type="radio" class="form-check-input" name="status_serving" id="released" value="3" style="margin-left:3%">
                                                </label> 
                                            @endif
                                                <span class="form-text text-danger"
                                                      id="error_released">{{ $errors->getBag('default')->first('released') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="{{action('OfferedController@index')}}">
                                            Cancel </a>
                                        @if(@$userDetails->id) 
                                            <button type="submit" class="btn btn-primary" disabled> Submit</button>
                                        @else
                                           <button type="submit" class="btn btn-primary"> Submit</button>
                                        @endif
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
                        $("#permanent_address").prop( "disabled", true )
                }
                else {
                    $("#current_address").val('');  
                    $("#permanent_address").prop( "disabled", false )

                }
            });
            $("#date_of_birth").datepicker();
            
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
                    emp_code: {
                        required: true
                    },
                    contact_number: {
                        required: true
                    },
                    alternate_number: {
                        required: true
                    },
                    permanent_address: {
                        required: true
                    },
                    current_address: {
                        required: true
                    },
                    father_name: {
                        required: true
                    },
                    mother_name: {
                        required: true
                    },
                    date_of_birth: {
                        required: true
                    },
                    date_of_joining: {
                        required: true
                    },
                    marital_status: {
                        required: true
                    },
                    name_of_spouse: {
                        required: true
                    },
                    total_years_experience: {
                        required: true
                    },
                    total_months_experience: {
                        required: true
                    },
                    highest_qualification: {
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
                    }
                    
                   
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
                    emp_code: {
                        required: "This emp code field is required.",
                    },
                    contact_number: {
                        required: "This contact number field is required.",
                    },
                    alternate_number: {
                        required: "This alternate number field is required.",
                    },
                    permanent_address: {
                        required: "This permanent address field is required.",
                    },
                    current_address: {
                        required: "This current address field is required.",
                    },
                    father_name: {
                        required: "This father name field is required.",
                    },
                    mother_name: {
                        required: "This mother name field is required.",
                    },
                    date_of_birth: {
                        required: "This date of birth field is required.",
                    },
                    date_of_joining: {
                        required: "This date of joining field is required.",
                    }, 
                    marital_status: {
                        required: "This marital status field is required.",
                    },
                    name_of_spouse: {
                        required: "This name of spouse field is required.",
                    },
                    total_years_experience: {
                        required: "This total years experience field is required.",
                    },
                    total_months_experience: {
                        required: "This total months experience field is required.",
                    },
                    highest_qualification: {
                        required:"This highest qualification field is required.",
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
