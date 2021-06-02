@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Final Round Interview Scheduling Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-user-check"></i>
                                    Final Round Interview Scheduling</a></li>
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
                                <a class="btn btn-danger" href="{{action('FinalRoundController@index')}}" style="float:right">
                                            Back </a>
                            </div>
                            <form role="form" action="{{action('FinalRoundController@store')}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input
                                                class="form-control"
                                                type="hidden"
                                                name="recruitment_id" id="recruitment_id" value="{{@$feedbackCandiate->recruitment->id}}">
                                                <input
                                                class="form-control"
                                                type="hidden"
                                                name="schedule_id" id="schedule_id" value="{{@$feedbackCandiate->schedule_id}}">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate</label>
                                                <input
                                                    class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                    maxlength="191"
                                                    value="{{old('name_of_candidate',@$feedbackCandiate->recruitment->name_of_candidate)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <br><br>
                                        @if(@$feedbackCandiate->schedule->final_round_interview_user_id)
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
                                                <label class=" form-control-label" for="final_round_interview_scheduling_date">Final Round Interview Scheduling Date</label>
                                                @if(@$feedbackCandiate->schedule->final_round_interview_scheduling_date)
                                                    <input
                                                            class="form-control  {{ $errors->has('final_round_interview_scheduling_date') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="final_round_interview_scheduling_date" id="final_round_interview_scheduling_date" placeholder="Please enter final round interview scheduling date"
                                                            maxlength="191"
                                                            value="{{@$feedbackCandiate->schedule->final_round_interview_scheduling_date}}" disabled>
                                                @else
                                                    <input
                                                            class="form-control  {{ $errors->has('final_round_interview_scheduling_date') ? 'is-invalid' : '' }}"
                                                            type="text"
                                                            name="final_round_interview_scheduling_date" id="final_round_interview_scheduling_date" placeholder="Please enter final round interview scheduling date"
                                                            maxlength="191"
                                                            value="" autocomplete="off">
                                                @endif
                                                
                                                        <span class="form-text text-danger"
                                                            id="error_final_round_interview_scheduling_date">{{ $errors->getBag('default')->first('final_round_interview_scheduling_date') }}</span>
                                            </div>
                                        </div>
                                            <div class="col-md-2">
                                                <br><br>
                                                <div class="col text-right">
                                                    <a class="btn btn-danger" href="{{action('FinalRoundController@index')}}">
                                                    Cancel </a>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label class=" form-control-label" for="final_round_interview_scheduling_time">Final Round Interview Scheduling Time</label>.
                                                    @if(@$feedbackCandiate->schedule->final_round_interview_scheduling_time)
                                                        <input
                                                                class="form-control timepicker {{ $errors->has('final_round_interview_scheduling_time') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="final_round_interview_scheduling_time" id="final_round_interview_scheduling_time" placeholder="Please enter final round interview scheduling time"
                                                                maxlength="191"
                                                                value="{{@$feedbackCandiate->schedule->final_round_interview_scheduling_time}}" disabled>
                                                    @else
                                                        <input
                                                                class="form-control timepicker {{ $errors->has('final_round_interview_scheduling_time') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="final_round_interview_scheduling_time" id="final_round_interview_scheduling_time" placeholder="Please enter final round interview scheduling time"
                                                                maxlength="191"
                                                                value="" autocomplete="off">
                                                    @endif
                                                            <span class="form-text text-danger"
                                                                id="error_final_round_interview_scheduling_time">{{ $errors->getBag('default')->first('final_round_interview_scheduling_time') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <br><br>
                                                @if(@$feedbackCandiate->schedule->final_round_interview_user_id)
                                                <div class="col text-right">
                                                    <a   id="btedit" class="btn btn-info" href="{{action('FinalRoundController@finalRoundInterviewSchedulingEdit',['id'=>@$feedbackCandiate->schedule->id])}}">
                                                    Edit </a>
                                                </div>
                                                @endif
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
                                                <label class=" form-control-label" for="final_round_interview_user_id"> </label>
                                                @if(@$feedbackCandiate->schedule->final_round_interview_user_id)
                                                    <select
                                                            class="form-control custom-select {{ $errors->has('final_round_interview_user_id') ? 'is-invalid' : '' }}"
                                                            name="final_round_interview_user_id" id="final_round_interview_user_id" disabled>
                                                            <option value="">SELECT</option>
                                                            @foreach ($interviewers as $interviewer)
                                                                <option value="{{$interviewer->id}}" @if(@$feedbackCandiate->schedule->final_round_interview_user_id==$interviewer->id) selected @endIf>{{$interviewer->name}}</option>
                                                            @endforeach
                                                   </select>
                                                @else
                                                    <select
                                                                class="form-control custom-select {{ $errors->has('final_round_interview_user_id') ? 'is-invalid' : '' }}"
                                                                name="final_round_interview_user_id" id="final_round_interview_user_id">
                                                                <option value="">SELECT</option>
                                                                @foreach ($interviewers as $interviewer)
                                                                    <option value="{{$interviewer->id}}">{{$interviewer->name}}</option>
                                                                @endforeach
                                                        </select>
                                                @endif
                                                <span class="form-text text-danger"
                                                      id="error_final_round_interview_user_id">{{ $errors->getBag('default')->first('final_round_interview_user_id') }}</span>
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
            $("#final_round_interview_scheduling_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });
            $('#final_round_interview_user_id').change(function(){
                var interview = ($('#final_round_interview_user_id option:selected').text());
                $('#interviewer').val(interview);
            })
            var interview = $('#final_round_interview_user_id option:selected').text();
            $('#interviewer').val(interview);
            
            $('#addReqForm').validate({
                rules: {
                    name_of_candidate: {
                        required: true
                    },
                    final_round_interview_scheduling_date: {
                        required: true,
                    },
                    final_round_interview_user_id: {
                        required: true
                    },
                },
                messages: {
                    name_of_candidate: {
                        required: "This name of candidate field is required.",
                    },
                    final_round_interview_scheduling_date: {
                        required: "This final round interview scheduling field is required.",
                    },
                    final_round_interview_user_id: {
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
                }, 3000);
            });
        });
    </script>
@endsection
