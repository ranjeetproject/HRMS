@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Interview Feedback Content</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Interview Feedback Content</li>
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
                                <div class="card-title">
                                    <i class="fas fa-plus-square"></i>
                                    Interview Feedback Content
                                </div>
                            </div>
                            @if($interview_feedback_contents[0]['id'])
                            <form action="{{action('InterviewFeedbackContentController@selectionUpdate',[$interview_feedback_contents[0]['id']])}}" method="post"
                                  enctype="multipart/form-data" id="selectionForm">
                            @else
                            <form action="{{action('InterviewFeedbackContentController@selectionStore')}}" method="post"
                                  enctype="multipart/form-data" id="selectionForm">
                            @endif
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="content_for_selection">Content for Selection <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                            @if($interview_feedback_contents[0]['content_for_selection'])
                                                <textarea
                                                        class="form-control {{ $errors->has('content_for_selection') ? 'is-invalid' : '' }}"
                                                        name="content_for_selection" id="content_for_selection" placeholder="Please enter content for selection">{{$interview_feedback_contents[0]['content_for_selection']}}</textarea>
                                                <span class="form-text text-danger"
                                                      id="error_content_for_selection">{{ $errors->getBag('default')->first('content_for_selection') }}</span>
                                            @else
                                                <textarea
                                                        class="form-control {{ $errors->has('content_for_selection') ? 'is-invalid' : '' }}"
                                                        name="content_for_selection" id="content_for_selection" placeholder="Please enter content for selection"></textarea>
                                                <span class="form-text text-danger"
                                                      id="error_content_for_selection">{{ $errors->getBag('default')->first('content_for_selection') }}</span>
                                            @endIf
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary"> Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

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
                                <div class="card-title">
                                    <i class="fas fa-plus-square"></i>
                                    Interview Feedback Content
                                </div>
                            </div>
                            @if($interview_feedback_contents[1]['id'])
                                <form action="{{action('InterviewFeedbackContentController@rejectionUpdate',[$interview_feedback_contents[1]['id']])}}" method="post"
                                    enctype="multipart/form-data" id="rejectionForm">
                            @else
                                <form action="{{action('InterviewFeedbackContentController@rejectionStore')}}" method="post"
                                    enctype="multipart/form-data" id="rejectionForm">
                            @endif
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="content_for_rejection">Content for Rejection<span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                            @if($interview_feedback_contents[1]['content_for_rejection'])
                                                <textarea
                                                        class="form-control {{ $errors->has('content_for_rejection') ? 'is-invalid' : '' }}"
                                                        name="content_for_rejection" id="content_for_rejection" placeholder="Please enter content for rejection">{{$interview_feedback_contents[1]['content_for_rejection']}}</textarea>
                                                <span class="form-text text-danger"
                                                      id="error_content_for_rejection">{{ $errors->getBag('default')->first('content_for_rejection') }}</span>
                                            @else
                                                <textarea
                                                        class="form-control {{ $errors->has('content_for_rejection') ? 'is-invalid' : '' }}"
                                                        name="content_for_rejection" id="content_for_rejection" placeholder="Please enter content for rejection"></textarea>
                                                <span class="form-text text-danger"
                                                      id="error_content_for_rejection">{{ $errors->getBag('default')->first('content_for_rejection') }}</span>
                                            @endIf
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary"> Submit</button>
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
    <script type="text/javascript">
        var baseUrl = '{{asset('/')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $('#selectionForm').validate({
                rules: {
                    content_for_selection: {
                        required: true
                    },
                },
                messages: {
                    content_for_selection: {
                        required: "This content for selection field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });

            $('#rejectionForm').validate({
                rules: {
                    content_for_rejection: {
                        required: true
                    },
                },
                messages: {
                    content_for_rejection: {
                        required: "This content for rejection field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });
            $('#rejectionForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

            $('#selectionForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });

    </script>
@endsection