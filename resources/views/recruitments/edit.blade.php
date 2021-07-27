@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Recruitment Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-address-card"></i>
                                    Recruitment</a></li>
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
                                <h3 class="card-title"><i class="fas fa-align-justify"></i> Update</h3>
                                <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}" style="float:right">
                                            Back </a>
                            </div>
                            <form role="form" action="{{action('RecruitmentController@update',[$recruitment->id])}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate &nbsp;<span style="color:red">*</span></label>
                                                <input
                                                    class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                    maxlength="191"
                                                    value="{{old('name_of_candidate',$recruitment->name_of_candidate)}}">
                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="mobile_number">Mobile Number &nbsp;<span style="color:red">*</span></label>
                                                <input
                                                    class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="mobile_number" id="mobile_number" placeholder="Please enter mobile number"
                                                    maxlength="191"
                                                    value="{{old('mobile_number',$recruitment->mobile_number)}}">
                                                <span class="form-text text-danger"
                                                      id="error_mobile_number">{{ $errors->getBag('default')->first('mobile_number') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="alternate_number">Alternate Number</label>
                                                <input
                                                    class="form-control {{ $errors->has('alternate_number') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="alternate_number" id="alternate_number" placeholder="Please enter alternate number"
                                                    maxlength="191"
                                                    value="{{old('alternate_number',$recruitment->alternate_number)}}">

                                                <span class="form-text text-danger"
                                                      id="error_alternate_number">{{ $errors->getBag('default')->first('alternate_number') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="total_years_experience">Total Experience &nbsp;<span style="color:red">*</span></label>
                                                <select
                                                    class="form-control custom-select {{ $errors->has('total_years_experience') ? 'is-invalid' : '' }}"
                                                    name="total_years_experience" id="total_years_experience">
                                                    <option value="{{$recruitment->total_years_experience}}">{{$recruitment->total_years_experience}} Years</option>
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

                                                <span class="form-text text-danger"
                                                      id="error_total_years_experience">{{ $errors->getBag('default')->first('total_years_experience') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label" for="total_months_experience"><br></label>
                                                <select
                                                    class="form-control custom-select {{ $errors->has('total_months_experience') ? 'is-invalid' : '' }}"
                                                    name="total_months_experience" id="total_months_experience">
                                                    <option value="{{$recruitment->total_months_experience}}">{{$recruitment->total_months_experience}} Months</option>
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
                                                <span class="form-text text-danger"
                                                      id="error_total_months_experience">{{ $errors->getBag('default')->first('total_months_experience') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="address">Address</label>
                                                <textarea
                                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                    name="address" id="address" placeholder="Please enter address">{{old('address',$recruitment->address)}}</textarea>

                                                <span class="form-text text-danger"
                                                      id="error_address">{{ $errors->getBag('default')->first('address') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="relevent_years_experience">Relevent Experience</label>
                                                <select
                                                    class="form-control custom-select {{ $errors->has('relevent_years_experience') ? 'is-invalid' : '' }}"
                                                    name="relevent_years_experience" id="relevent_years_experience">
                                                    <option value="{{$recruitment->relevent_years_experience}}">{{$recruitment->relevent_years_experience}} Years</option>
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

                                                <span class="form-text text-danger"
                                                      id="error_relevent_years_experience">{{ $errors->getBag('default')->first('relevent_years_experience') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="relevent_months_experience"><br></label>
                                                <select
                                                    class="form-control custom-select {{ $errors->has('relevent_months_experience') ? 'is-invalid' : '' }}"
                                                    name="relevent_months_experience" id="relevent_months_experience">
                                                    <option value="{{$recruitment->relevent_months_experience}}">{{$recruitment->relevent_months_experience}} Months</option>
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

                                                <span class="form-text text-danger"
                                                      id="error_relevent_months_experience">{{ $errors->getBag('default')->first('relevent_months_experience') }}</span>
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="email_id">Email ID &nbsp;<span style="color:red">*</span></label>
                                               <input
                                                    class="form-control {{ $errors->has('email_id') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="email_id" id="email_id" placeholder="Please enter email id"
                                                    maxlength="191"
                                                    value="{{old('email_id',$recruitment->email_id)}}">

                                                <span class="form-text text-danger"
                                                      id="error_email_id">{{ $errors->getBag('default')->first('email_id') }}</span>
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="application_for">Application For &nbsp;<span style="color:red">*</span></label>
                                               <input
                                                    class="form-control {{ $errors->has('application_for') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="application_for" id="application_for" placeholder="Please enter application for"
                                                    maxlength="191"
                                                    value="{{old('application_for',$recruitment->application_for)}}">

                                                <span class="form-text text-danger"
                                                      id="error_application_for">{{ $errors->getBag('default')->first('application_for') }}</span>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="highest_qualification">Highest Qualification</label>
                                               <input
                                                    class="form-control {{ $errors->has('highest_qualification') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="highest_qualification" id="highest_qualification" placeholder="Please enter highest qualification"
                                                    maxlength="191"
                                                    value="{{old('highest_qualification',$recruitment->highest_qualification)}}">

                                                <span class="form-text text-danger"
                                                      id="error_highest_qualification">{{ $errors->getBag('default')->first('highest_qualification') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="current_ctc">Current CTC &nbsp;<span style="color:red">*</span></label>
                                               <input
                                                    class="form-control {{ $errors->has('current_ctc') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="current_ctc" id="current_ctc" placeholder="Please enter current ctc"
                                                    maxlength="191"
                                                    value="{{old('current_ctc',$recruitment->current_ctc)}}">

                                                <span class="form-text text-danger"
                                                      id="error_current_ctc">{{ $errors->getBag('default')->first('current_ctc') }}</span>
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="expected_ctc">Expected CTC &nbsp;<span style="color:red">*</span></label>
                                               <input
                                                    class="form-control {{ $errors->has('expected_ctc') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="expected_ctc" id="expected_ctc" placeholder="Please enter expected ctc"
                                                    maxlength="191"
                                                    value="{{old('expected_ctc',$recruitment->expected_ctc)}}">

                                                <span class="form-text text-danger"
                                                      id="error_expected_ctc">{{ $errors->getBag('default')->first('expected_ctc') }}</span>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="current_location">Current Location</label>
                                               <input
                                                    class="form-control {{ $errors->has('current_location') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="current_location" id="current_location" placeholder="Please enter current location"
                                                    maxlength="191"
                                                    value="{{old('current_location',$recruitment->current_location)}}">

                                                <span class="form-text text-danger"
                                                      id="error_current_location">{{ $errors->getBag('default')->first('current_location') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-4">
                                            <label class=" form-control-label" for="skill">Skills/Technology &nbsp;<span style="color:red">*</span></label>
                                                <ul class="list-group list-group-flush" style="overflow: auto;">
                                                  @foreach($skills as $skill)
                                                    <li class="list-group-item"> <input type="checkbox" class="form-check-input" name="skill[]" id="skill" value="{{$skill->id}}" @if(in_array($skill->id,$skilldata)) {{'checked'}} @endIf >{{$skill->skill_name}}</li>
                                                  @endforeach
                                                </ul>
                                                 <span class="form-text text-danger"
                                                        id="error_skill">{{ $errors->getBag('default')->first('skill') }}</span>
                                        </div>
                                        <div class="col-md-8">
                                           <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="notice_period">Notice Period &nbsp;<span style="color:red">*</span></label>
                                                    <input
                                                        class="form-control {{ $errors->has('notice_period') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="notice_period" id="notice_period" placeholder="Please enter notice period"
                                                        maxlength="191"
                                                        value="{{old('notice_period',$recruitment->notice_period)}}">

                                                    <span class="form-text text-danger"
                                                        id="error_notice_period">{{ $errors->getBag('default')->first('notice_period') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="refferdby">Refferd By</label>
                                                    <input
                                                        class="form-control {{ $errors->has('refferdby') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="refferdby" id="refferdby" placeholder="Please enter reffered by"
                                                        maxlength="191"
                                                        value="{{old('refferdby',$recruitment->refferdby)}}">

                                                    <span class="form-text text-danger"
                                                        id="error_refferdby">{{ $errors->getBag('default')->first('refferdby') }}</span>
                                                </div>
                                            </div>
                                           </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="special_remarks">Special Remarks</label>
                                                <textarea
                                                    class="form-control {{ $errors->has('special_remarks') ? 'is-invalid' : '' }}"
                                                    name="special_remarks" id="special_remarks" placeholder="Please enter special remarks">{{old('special_remarks',$recruitment->special_remarks)}}</textarea>

                                                    <span class="form-text text-danger"
                                                        id="error_special_remarks">{{ $errors->getBag('default')->first('special_remarks') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="upload_resume">Upload Resume &nbsp;<span style="color:red">*</span></label>
                                                    <input
                                                        class="form-control {{ $errors->has('upload_resume') ? 'is-invalid' : '' }}"
                                                        type="file"
                                                        name="upload_resume" id="InputFile" placeholder="Please upload resume"
                                                        maxlength="191"
                                                        value="{{old('upload_resume')}}">

                                                    <span class="form-text text-danger"
                                                        id="error_upload_resume">{{ $errors->getBag('default')->first('upload_resume') }}</span>
                                                        @if(@$recruitment->upload_resume!='')
                                                        <img src="{{asset('uploadimg/Zpt8n.jpg')}}" height="40px" width="40px" />
                                                        @endif
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}">
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
            $('#addReqForm').validate({
                rules: {
                    name_of_candidate: {
                        required: true
                    },
                    mobile_number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    total_years_experience: {
                        required: true
                    },
                    total_months_experience: {
                        required: true
                    },
                    email_id: {
                        required: true,
                         email: true,
                    },
                    application_for: {
                        required: true
                    },
                    current_ctc: {
                        required: true
                    },
                    expected_ctc: {
                        required: true
                    },
                    'skill[]': {
                        required: true
                    },
                    notice_period: {
                        required: true,
                        number: true,
                    },
                   
                },
                messages: {
                    name_of_candidate: {
                        required: "This name of candidate field is required.",
                    },
                    mobile_number: {
                        required: "This mobile number field is required.",
                        number: "This mobile number field is take number",
                        minlength: "This mobile number field minimum length is 10",
                        maxlength: "This mobile number field maxlength is 10",
                    },
                    total_years_experience: {
                        required: "This total years experience field is required.",
                    },
                    total_months_experience: {
                        required: "This total months experience field is required.",
                    },
                    email_id: {
                        required: "This email id field is required.",
                        email: "Please enter correct email id",
                    },
                    application_for: {
                        required: "This application for field is required.",
                    },
                    current_ctc: {
                        required: "This current ctc field is required.",
                    }, 
                    expected_ctc: {
                        required: "This expected ctc field is required.",
                    },
                    'skill[]': {
                        required: "This skill field is required.",
                    },
                    notice_period: {
                        required: "This notice period field is required.",
                        number: "This notice period field is take number",
                        minlength: "This notice period field minimum length is 1",
                        maxlength: "This notice period field maxlength is 1"
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
        function readURL(input) 
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#toUpload').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#InputFile").change(function() {
            readURL(this);
        });
    </script>
@endsection
