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
                                <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}" style="float:right">
                                            Back </a>
                            </div>
                            <form role="form" action="{{action('InterviewScheduleController@store')}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input
                                                class="form-control"
                                                type="hidden"
                                                name="recruitment_id" id="recruitment_id" value="{{@$recruitment->id}}">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate</label>
                                                <input
                                                    class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                    maxlength="191"
                                                    value="{{old('name_of_candidate',@$recruitment->name_of_candidate)}}" readonly autocomplete="off">
                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <br><br>
                                        @if(@$schedule->id)
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-primary" disabled> Submit</button>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-primary"> Submit</button>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interview_scheduling_date">Interview Schedule Date &nbsp;<span style="color:red">*</span></label>
                                                
                                                @if(@$schedule->interview_scheduling_date)
                                                    <input
                                                            class="form-control {{ $errors->has('interview_scheduling_date') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="interview_scheduling_date" id="interview_scheduling_date" placeholder="Please enter interview scheduling date"
                                                            maxlength="191"
                                                            value="{{old('interview_scheduling_date',@$schedule->interview_scheduling_date)}}" disabled autocomplete="off">
                                                @else
                                                    <input
                                                            class="form-control  {{ $errors->has('interview_scheduling_date') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="interview_scheduling_date" id="interview_scheduling_date" placeholder="Please enter interview scheduling date"
                                                            maxlength="191"
                                                            value="" autocomplete="off">
                                                @endIf
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
                                                    <label class=" form-control-label" for="interview_scheduling_time">Interview Schedule Time &nbsp;<span style="color:red">*</span></label>
                                                    @if(@$schedule->interview_scheduling_time)
                                                        <input
                                                                class="form-control {{ $errors->has('interview_scheduling_time') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="interview_scheduling_time" id="interview_scheduling_time" placeholder="Please enter interview scheduling date"
                                                                maxlength="191"
                                                                value="{{old('interview_scheduling_time',@$schedule->interview_scheduling_time)}}" disabled autocomplete="off">
                                                    @else
                                                        <input
                                                                class="form-control timepicker {{ $errors->has('interview_scheduling_time') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="interview_scheduling_time" id="interview_scheduling_time" placeholder="Please enter interview scheduling time"
                                                                maxlength="191"
                                                                value="" autocomplete="off">
                                                    @endIf
                                                    <span class="form-text text-danger"
                                                        id="error_interview_scheduling_time">{{ $errors->getBag('default')->first('interview_scheduling_time') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <br><br>
                                                @if(@$schedule->id)
                                                <div class="col text-right">
                                                    <a   id="btedit" class="btn btn-info" href="{{action('InterviewScheduleController@interviewSchedulingEdit',['id'=>@$recruitment->id])}}">
                                                    Edit </a>
                                                </div>
                                                @endif
                                            </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interviewer">Interviewer &nbsp;<span style="color:red">*</span></label>
                                                @if(@$schedule->user_id)
                                               <input
                                                    class="form-control {{ $errors->has('interviewer') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="interviewer" id="interviewer" placeholder="Please select interviewer name"
                                                    maxlength="191"
                                                    value="{{old('interviewer')}}" readonly autocomplete="off">
                                                @else
                                                <input
                                                    class="form-control {{ $errors->has('interviewer') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="interviewer" id="interviewer" placeholder="Please select interviewer name"
                                                    maxlength="191"
                                                    value="{{old('interviewer')}}" autocomplete="off">
                                                @endIf
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
                                                @if(@$schedule->user_id)
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                                        name="user_id" id="user_id" disabled>
                                                        <option value="">SELECT</option>
                                                        @foreach ($interviewers as $interviewer)
                                                            <option value="{{$interviewer->id}}" @if(@$schedule->user_id==$interviewer->id) selected @endIf>{{$interviewer->name}}</option>
                                                         @endforeach
                                                    </select>
                                                @else
                                                    <select
                                                            class="form-control custom-select {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                                            name="user_id" id="user_id">
                                                            <option value="">SELECT</option>
                                                            @foreach ($interviewers as $interviewer)
                                                                <option value="{{$interviewer->id}}">{{$interviewer->name}}</option>
                                                            @endforeach
                                                    </select>
                                                @endIf
                                                <span class="form-text text-danger"
                                                      id="error_user_id">{{ $errors->getBag('default')->first('user_id') }}</span>
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
            $('.timepicker').datetimepicker({
                format: 'LT'
            });
            $("#interview_scheduling_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });
            $('#user_id').change(function(){
                var interview = ($('#user_id option:selected').text());
                $('#interviewer').val(interview);
            })
            var interview = $('#user_id option:selected').text();
            $('#interviewer').val(interview);
            
            $('#addReqForm').validate({
                rules: {
                    name_of_candidate: {
                        required: true
                    },
                    interview_scheduling_date: {
                        required: true,
                    },
                    interview_scheduling_time: {
                        required: true,
                    },
                    user_id: {
                        required: true
                    },
                },
                messages: {
                    name_of_candidate: {
                        required: "This name of candidate field is required.",
                    },
                    interview_scheduling_date: {
                        required: "This interview scheduling field is required.",
                    },
                    interview_scheduling_time: {
                        required: "This interview scheduling time field is required.",
                    },
                    user_id: {
                        required: "This interviewer field is required.",
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
