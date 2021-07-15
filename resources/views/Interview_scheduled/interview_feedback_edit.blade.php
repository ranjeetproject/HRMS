@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Interview Feedback Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-address-card"></i>
                                    Interview Feedback</a></li>
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
                                <h3 class="card-title"><i class="fas fa-align-justify"></i> Edit</h3>
                                <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}" style="float:right">
                                            Back </a>
                            </div>
                            <form role="form" action="{{action('InterviewFeedbackController@update',[@$feedback->id])}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input
                                                class="form-control"
                                                type="hidden"
                                                name="recruitment_id" id="recruitment_id" value="{{@$feedback->recruitment->id}}">
                                                <input
                                                class="form-control"
                                                type="hidden"
                                                name="schedule_id" id="schedule_id" value="{{@$feedback->schedule->id}}">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate</label>
                                                <input
                                                    class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                    maxlength="191"
                                                    value="{{old('name_of_candidate',@$feedback->recruitment->name_of_candidate)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <br><br>
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-primary" > Update</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interview_scheduling_date">Interview Schedule Date &nbsp;<span style="color:red">*</span></label>
                                               <input
                                                    class="form-control {{ $errors->has('interview_scheduling_date') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="interview_scheduling_date" id="interview_scheduling_date" placeholder="Please enter interview scheduling date"
                                                    maxlength="191"
                                                    value="{{old('interview_scheduling_date',@$feedback->interview_scheduling_date)}}" readonly>

                                                <span class="form-text text-danger"
                                                      id="error_interview_scheduling_date">{{ $errors->getBag('default')->first('interview_scheduling_date') }}</span>
                                            </div>
                                        </div>
                                            <div class="col-md-2">
                                                <br><br>
                                                <div class="col text-right">
                                                    <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}">
                                                    Cancel </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                                    <label class=" form-control-label" for="interview_scheduling_time">Interview Time &nbsp;<span style="color:red">*</span></label>
                                                        <input
                                                                class="form-control timepicker {{ $errors->has('interview_scheduling_time') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="interview_scheduling_time" id="interview_scheduling_time" placeholder="Please enter interview scheduling date"
                                                                maxlength="191"
                                                                value="{{old('interview_scheduling_time',@$feedback->interview_scheduling_time)}}" readonly>
                                                   
                                                    <span class="form-text text-danger"
                                                        id="error_interview_scheduling_time">{{ $errors->getBag('default')->first('interview_scheduling_time') }}</span>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interviewer">Interviewer </label>
                                               <input
                                                    class="form-control {{ $errors->has('interviewer') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="interviewer" id="interviewer" placeholder="Please select interviewer name"
                                                    maxlength="191"
                                                    value="{{old('interviewer')}}" readonly>

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
                                                <label class=" form-control-label" for="user_id"> </label>
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                                        name="user_id" id="user_id" disabled>
                                                        <option value="">SELECT</option>
                                                        @foreach ($interviewers as $interviewer)
                                                            <option value="{{$interviewer->id}}" @if(@$feedback->user_id==$interviewer->id) selected @endIf>{{$interviewer->name}}</option>
                                                        @endforeach
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_user_id">{{ $errors->getBag('default')->first('user_id') }}</span>
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
                                                                class="form-control {{ $errors->has('interviewer_rating') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="interviewer_rating" id="interviewer_rating" placeholder="Please enter interviewer rating"
                                                                maxlength="191"
                                                                value="{{old('interviewer_rating',@$feedback->interviewer_rating)}}">

                                                        <span class="form-text text-danger"
                                                            id="error_interviewer_rating">{{ $errors->getBag('default')->first('interviewer_rating') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="interviewer_feedback">Interviewer Feedback &nbsp;<span style="color:red">*</span></label>
                                                          <textarea
                                                            class="form-control {{ $errors->has('interviewer_feedback') ? 'is-invalid' : '' }}"
                                                            name="interviewer_feedback" id="interviewer_feedback" placeholder="Please enter interviewer feedback">{{old('interviewer_feedback',@$feedback->interviewer_feedback)}}</textarea>

                                                        <span class="form-text text-danger"
                                                            id="error_interviewer_feedback">{{ $errors->getBag('default')->first('interviewer_feedback') }}</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class=" form-control-label" for="active"><input type="radio" name="active" value="1" @if(@$feedback->active == 1) {{'checked'}} @endIf> &nbsp;&nbsp;Selected for Final Round</label>
                                                    
                                                                <span class="form-text text-danger"
                                                                    id="error_active">{{ $errors->getBag('default')->first('active') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class=" form-control-label" for="active"><input type="radio" name="active" value="2" @if(@$feedback->active == 2) {{'checked'}} @endIf> &nbsp;&nbsp;Rejected</label>
                                                    
                                                                <span class="form-text text-danger"
                                                                    id="error_active">{{ $errors->getBag('default')->first('active') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class=" form-control-label" for="active"><input type="radio" name="active" value="3" @if(@$feedback->active == 3) {{'checked'}} @endIf> &nbsp;&nbsp;On Hold</label>
                                                    
                                                                <span class="form-text text-danger"
                                                                    id="error_active">{{ $errors->getBag('default')->first('active') }}</span>
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

            $('#user_id').change(function(){
                var interview = ($('#user_id option:selected').text());
                console.log(interview);
                $('#interviewer').val(interview);
            })
            var interview = $('#user_id option:selected').text();
            $('#interviewer').val(interview);

            $('#addReqForm').validate({
                rules: {
                    interviewer_feedback: {
                        required: true
                    },
                },
                messages: {
                    interviewer_feedback: {
                        required: "This interviewer feedback field is required.",
                    },
                   
                },
                errorElement: "span",
                errorClass: "form-text text-danger is-invalid"
            });
            $('#addReqForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 4000);
            });
        });
    </script>
@endsection
