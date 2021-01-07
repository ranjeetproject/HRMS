@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Skills</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-book"></i> Skills</li>
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
                                    <h3 class="card-title"><i class="fas fa-plus-square"></i>
                                        Skills</h3>
                                    <a class="btn btn-danger" href="{{action('SkillController@index')}}" style="margin-right:60%">
                                            Back </a>
                                </div>
                            </div>
                            <form action="{{action('SkillController@update',[$skill->id])}}" method="post"
                                  enctype="multipart/form-data" id="skillForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="skill_name">Skill Name <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input class="form-control {{ $errors->has('skill_name') ? 'is-invalid' : '' }}"
                                                    type="text" name="skill_name" id="skill_name" placeholder="Please enter skill name"
                                                    maxlength="191" value="{{old('skill_name',$skill->skill_name)}}">
                                                <span class="form-text text-danger"
                                                      id="error_skill_name">{{ $errors->getBag('default')->first('skill_name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
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
    <script type="text/javascript">
        var baseUrl = '{{asset('/')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $('#skillForm').validate({
                rules: {
                    skill_name: {
                        required: true
                    },
                },
                messages: {
                    skill_name: {
                        required: "This skill name field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#skillForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
       


    </script>
@endsection


