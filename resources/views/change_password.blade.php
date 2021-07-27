@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Change Password</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="fas fa-user-lock mr-2"></i>Change-Password</li>
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
                                    Change Password Form
                                </div>
                            </div>
                            <form action="{{action('UserController@changePasswordSubmit')}}" method="post" id="changePasswordForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="old_password">Enter Old Password <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}"
                                                    type="password" name="old_password" id="old_password" placeholder="Please Enter Old Password"
                                                    maxlength="191" value="{{old('old_password')}}">
                                                <span class="form-text text-danger"
                                                      id="error_old_password">{{ $errors->getBag('default')->first('old_password') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="new_password">Enter New Password <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                                    type="password" name="new_password" id="new_password" placeholder="Please Enter New Password"
                                                    maxlength="191" value="{{old('new_password')}}">
                                                <span class="form-text text-danger"
                                                      id="error_new_password">{{ $errors->getBag('default')->first('new_password') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="confirm_password">Enter Confirm Password <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}"
                                                    type="password" name="confirm_password" id="confirm_password" placeholder="Please Enter Confirm Password"
                                                    maxlength="191" value="{{old('confirm_password')}}">
                                                <span class="form-text text-danger"
                                                      id="error_confirm_password">{{ $errors->getBag('default')->first('confirm_password') }}</span>
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
            
            $('#changePasswordForm').validate({
                rules: {
                    old_password: {
                        required: true
                    },
                    new_password: {
                        required: true
                    },
                    confirm_password: {
                        required: true
                    },
                },
                messages: {
                    old_password: {
                        required: "This old password field is required.",
                    },
                    new_password: {
                        required: "This new password field is required.",
                    },
                    confirm_password: {
                        required: "This confirm password field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#changePasswordForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
</script>
@endsection