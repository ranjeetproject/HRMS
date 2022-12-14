@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Final Round Interview Feedback Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-address-card"></i>
                                    Final Round Interview Feedback</a></li>
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
                            <form role="form" action="{{action('FinalRoundController@finalRoundFeedbackStore')}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input
                                                class="form-control"
                                                type="hidden"
                                                name="recruitment_id" id="recruitment_id" value="{{@$final_round_feedback_schedule->recruitment_id}}">
                                                <input
                                                class="form-control"
                                                type="hidden"
                                                name="feedback_id" id="feedback_id" value="{{@$final_round_feedback_schedule->id}}">
                                               <label class="form-control-label" for="name_of_candidate">Name of Candidate</label>
                                                <input
                                                    class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                    maxlength="191"
                                                    value="{{old('name_of_candidate',@$final_round_feedback_schedule->recruitment->name_of_candidate)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <br><br>
                                            <div class="col text-right">
                                            @if(@$final_round_feedback_schedule->offered_ctc)
                                                <button type="submit" class="btn btn-primary" disabled> Submit</button>
                                            @else
                                                <button type="submit" class="btn btn-primary" > Submit</button>
                                            @endIf
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="final_round_interview_scheduling_date">Final Round Interview Scheduling Date &nbsp;<span style="color:red">*</span></label>
                                               <input
                                                    class="form-control {{ $errors->has('final_round_interview_scheduling_date') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="final_round_interview_scheduling_date" id="final_round_interview_scheduling_date" placeholder="Please enter final round interview scheduling date"
                                                    maxlength="191"
                                                    value="{{old('final_round_interview_scheduling_date',@$final_round_feedback_schedule->schedule->final_round_interview_scheduling_date)}}" readonly>

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
                                                    <label class=" form-control-label" for="final_round_interview_scheduling_time">Final Round Interview Time &nbsp;<span style="color:red">*</span></label>
                                                        <input
                                                                class="form-control timepicker {{ $errors->has('final_round_interview_scheduling_time') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="final_round_interview_scheduling_time" id="final_round_interview_scheduling_time" placeholder="Please enter final round interview scheduling date"
                                                                maxlength="191"
                                                                value="{{old('interview_scheduling_time',@$final_round_feedback_schedule->schedule->final_round_interview_scheduling_time)}}" readonly>
                                            
                                                    <span class="form-text text-danger"
                                                        id="error_final_round_interview_scheduling_time">{{ $errors->getBag('default')->first('final_round_interview_scheduling_time') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <br><br>
                                                @if(@$final_round_feedback_schedule->final_round_interviewer_feedback)
                                                <div class="col text-right">
                                                    <a   id="btedit" class="btn btn-info" href="{{action('FinalRoundController@finalRoundInterviewFeedbackEdit',['id'=>@$final_round_feedback_schedule->id])}}">
                                                    Edit </a>
                                                </div>
                                                @endif
                                            </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="interviewer">interviewer </label>
                                               <input
                                                    class="form-control {{ $errors->has('interviewer') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="interviewer" id="interviewer" placeholder="Please select interviewer name"
                                                    maxlength="191"
                                                    value="{{old('interviewer')}}" disabled>

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
                                                    <select
                                                        class="form-control custom-select {{ $errors->has('final_round_interview_user_id') ? 'is-invalid' : '' }}"
                                                        name="final_round_interview_user_id" id="final_round_interview_user_id" readonly>
                                                        <option value="">SELECT</option>
                                                        @foreach ($interviewers as $interviewer)
                                                            <option value="{{$interviewer->id}}" @if(@$final_round_feedback_schedule->schedule->final_round_interview_user_id == $interviewer->id) selected @endIf>{{$interviewer->name}}</option>
                                                        @endforeach
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_final_round_interview_user_id">{{ $errors->getBag('default')->first('final_round_interview_user_id') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-md-6 border border-dark">
                                            <div class="row container-sm">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="offered_ctc">Offered CTC </label>
                                                        @if(@$final_round_feedback_schedule->offered_ctc)
                                                            <input
                                                                    class="form-control {{ $errors->has('offered_ctc') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="offered_ctc" id="offered_ctc" placeholder="Please enter offered ctc"
                                                                    maxlength="191"
                                                                    value="{{old('offered_ctc',@$final_round_feedback_schedule->offered_ctc)}}" readonly>
                                                        @else
                                                            <input
                                                                    class="form-control {{ $errors->has('offered_ctc') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="offered_ctc" id="offered_ctc" placeholder="Please enter offered ctc"
                                                                    maxlength="191"
                                                                    value="{{old('offered_ctc')}}" autocomplete="off">
                                                        @endIf

                                                        <span class="form-text text-danger"
                                                            id="error_offered_ctc">{{ $errors->getBag('default')->first('offered_ctc') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="final_round_interviewer_feedback">Interviewer Feedback &nbsp;<span style="color:red">*</span></label>
                                                        @if(@$final_round_feedback_schedule->final_round_interviewer_feedback)
                                                            <textarea
                                                                class="form-control {{ $errors->has('final_round_interviewer_feedback') ? 'is-invalid' : '' }}"
                                                                name="final_round_interviewer_feedback" id="final_round_interviewer_feedback" placeholder="Please enter final round interviewer feedback" readonly>{{old('final_round_interviewer_feedback',@$final_round_feedback_schedule->final_round_interviewer_feedback)}}</textarea>
                                                        
                                                        @else
                                                        <textarea
                                                                class="form-control {{ $errors->has('final_round_interviewer_feedback') ? 'is-invalid' : '' }}"
                                                                name="final_round_interviewer_feedback" id="final_round_interviewer_feedback" placeholder="Please enter final round interviewer feedback">{{old('final_round_interviewer_feedback')}}</textarea>
                                                        @endIf
                                                        <span class="form-text text-danger"
                                                            id="error_final_round_interviewer_feedback">{{ $errors->getBag('default')->first('final_round_interviewer_feedback') }}</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class=" form-control-label" for="date_of_joining">Date of Joining</label>
                                                            @if(@$final_round_feedback_schedule->date_of_joining == '1970-01-01')
                                                                <input
                                                                    class="form-control {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="date_of_joining" id="date_of_joining" placeholder="Please enter date of joining"
                                                                    value="" autocomplete="off">
                                                            @elseif(@$final_round_feedback_schedule->date_of_joining)
                                                                <input
                                                                    class="form-control {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="date_of_joining" id="date_of_joining" placeholder="Please enter date of joining"
                                                                    value="{{old('date_of_joining',@$final_round_feedback_schedule->date_of_joining)}}" disabled>
                                                            @else
                                                            <input
                                                                class="form-control {{ $errors->has('date_of_joining') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="date_of_joining" id="date_of_joining" placeholder="Please enter date of joining"
                                                                value="{{old('date_of_joining')}}"  autocomplete="off">
                                                            @endIf
                                                            <span class="form-text text-danger"
                                                                id="error_date_of_joining">{{ $errors->getBag('default')->first('date_of_joining') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                        @if(@$final_round_feedback_schedule->offered)
                                                            <label class=" form-control-label" for="offered"><input type="checkbox" name="offered" value="" @if(@$final_round_feedback_schedule->offered) {{'checked'}} @endIf> &nbsp;&nbsp;Offered</label>
                                                        @else
                                                            <label class=" form-control-label" for="offered"><input type="checkbox" name="offered" value=""> &nbsp;&nbsp;Offered</label>
                                                        @endIf

                                                            <span class="form-text text-danger"
                                                                id="error_offered">{{ $errors->getBag('default')->first('offered') }}</span>
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
            $('.timepicker').datetimepicker({
                format: 'LT'
            });

            $("#date_of_joining").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });

            $('#userfinal_round_interview_user_id_id').change(function(){
                var interview = ($('#final_round_interview_user_id option:selected').text());
                console.log(interview);
                $('#interviewer').val(interview);
            })
            var interview = $('#final_round_interview_user_id option:selected').text();
            $('#interviewer').val(interview);

            $('#addReqForm').validate({
                rules: {
                    final_round_interview_scheduling_date: {
                        required: true
                    },
                    final_round_interview_scheduling_time: {
                        required: true
                    },
                    final_round_interviewer_feedback: {
                        required: true
                    },
                   
                },
                messages: {
                    final_round_interview_scheduling_date: {
                        required: "This final round interview scheduling date field is required.",
                    },
                    final_round_interview_scheduling_time: {
                        required: "This final round interview scheduling time field is required.",
                    },
                    final_round_interviewer_feedback: {
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
