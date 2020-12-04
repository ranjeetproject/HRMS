@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Interview Scheduling Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-address-card"></i>
                                    Interview Scheduling</a></li>
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
                            </div>
                            <form role="form" action="{{action('RecruitmentController@store')}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate</label>
                                                <input
                                                    class="form-control {{ $errors->has("name_of_candidate") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                    maxlength="191"
                                                    value="{{old('name_of_candidate')}}">
                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <br><br>
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-primary"> Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interview_scheduling_date">Interview Scheduling</label>
                                               <input
                                                    class="form-control {{ $errors->has("interview_scheduling_date") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="interview_scheduling_date" id="interview_scheduling_date" placeholder="Please enter interview scheduling date"
                                                    maxlength="191"
                                                    value="{{old('interview_scheduling_date')}}">

                                                <span class="form-text text-danger"
                                                      id="error_interview_scheduling_date">{{ $errors->getBag('default')->first('interview_scheduling_date') }}</span>
                                            </div>
                                        </div>
                                            <div class="col-md-2">
                                                <br><br>
                                                <div class="col text-right">
                                                    <a class="btn btn-danger" href="">
                                                    Cancel </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interviewer">Interviewer </label>
                                               <input
                                                    class="form-control {{ $errors->has("interviewer") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="interviewer" id="interviewer" placeholder="Please select interviewer name"
                                                    maxlength="191"
                                                    value="{{old('interviewer')}}">

                                                <span class="form-text text-danger"
                                                      id="error_interviewer">{{ $errors->getBag('default')->first('interviewer') }}</span>
                                            </div>
                                        </div>
                                         <div class="col-md-1">
                                            <div class="form-group">
                                              <span style='font-size:60px;'>&#8680;</span>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interviewer"> </label>
                                                    <select
                                                        class="form-control custom-select {{ $errors->has("total_years_experience") ? 'is-invalid' : '' }}"
                                                        name="total_years_experience" id="total_years_experience">
                                                        <option value="">SELECT</option>
                                                        <option value="1">A</option>
                                                        <option value="2">B</option>
                                                        <option value="3">C</option>
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_interviewer">{{ $errors->getBag('default')->first('interviewer') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-md-6 border border-dark">
                                            <div class="row container-sm">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="interviewer_rating">Interviewer Rating</label>
                                                        <input
                                                                class="form-control {{ $errors->has("interviewer_rating") ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="interviewer_rating" id="interviewer_rating" placeholder="Please enter interviewer rating"
                                                                maxlength="191"
                                                                value="{{old('interviewer_rating')}}">

                                                        <span class="form-text text-danger"
                                                            id="error_interviewer_rating">{{ $errors->getBag('default')->first('interviewer_rating') }}</span>
                                                    </div>
                                                </div>
                                                 <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="interviewer_feedback">Interviewer Feedback</label>
                                                          <textarea
                                                            class="form-control {{ $errors->has("interviewer_feedback") ? 'is-invalid' : '' }}"
                                                            name="interviewer_feedback" id="interviewer_feedback" placeholder="Please enter interviewer feedback">{{old('interviewer_feedback')}}</textarea>

                                                        <span class="form-text text-danger"
                                                            id="error_interviewer_feedback">{{ $errors->getBag('default')->first('interviewer_feedback') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         
                                    </div>

                                    

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
                    },
                    alternate_number: {
                        required: true
                    },
                    total_years_experience: {
                        required: true
                    },
                    total_months_experience: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    relevent_years_experience: {
                        required: true
                    },
                    relevent_months_experience: {
                        required: true
                    },
                    email_id: {
                        required: true
                    },
                    application_for: {
                        required: true
                    },
                    highest_qualification: {
                        required: true
                    },
                    current_ctc: {
                        required: true
                    },
                    expected_ctc: {
                        required: true
                    },
                     current_location: {
                        required: true
                    },
                    'skill[]': {
                        required: true
                    },
                     notice_period: {
                        required: true
                    },
                    reffered_by: {
                        required: true
                    },
                    special_remarks: {
                        required: true
                    },
                },
                messages: {
                    name_of_candidate: {
                        required: "This name of candidate field is required.",
                    },
                    mobile_number: {
                        required: "This mobile number field is required.",
                    },
                    alternate_number: {
                        required: "This alternate number field is required.",
                    },
                    total_years_experience: {
                        required: "This total years experience field is required.",
                    },
                    total_months_experience: {
                        required: "This total months experience field is required.",
                    },
                    address: {
                        required: "This address field is required.",
                    },
                    relevent_years_experience: {
                        required: "This relevent years experience field is required.",
                    },
                    relevent_months_experience: {
                        required: "This relevent months experience field is required.",
                    },
                    email_id: {
                        required: "This email id field is required.",
                    },
                    application_for: {
                        required: "This application for field is required.",
                    },
                    highest_qualification: {
                        required: "This highest qualification field is required.",
                    },
                    current_ctc: {
                        required: "This current ctc field is required.",
                    }, 
                    expected_ctc: {
                        required: "This expected ctc field is required.",
                    },
                    current_location: {
                        required: "This current location field is required.",
                    },
                    'skill[]': {
                        required: "This skill field is required.",
                    },
                    notice_period: {
                        required: "This notice period field is required.",
                    },
                    reffered_by: {
                        required: "This reffered by field is required.",
                    },
                    special_remarks: {
                        required: "This special_remarks field is required.",
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
