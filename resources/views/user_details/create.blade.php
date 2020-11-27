@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>User Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="fa fa-pray"></i>
                                    User</a></li>
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
                            <form role="form" action="" method="POST"
                                  enctype="multipart/form-data" id="addempForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="category">Employee Category</label>
                                               
                                               
                                                <span class="form-text text-danger"
                                                      id="error_category">{{ $errors->getBag('default')->first('category') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">Name</label>
                                                <input
                                                    class="form-control {{ $errors->has("name") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name" id="name" placeholder="Please enter name"
                                                    maxlength="191"
                                                    value="{{old('name')}}">
                                                <span class="form-text text-danger"
                                                      id="error_name">{{ $errors->getBag('default')->first('name') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="email">Email</label>
                                                <input
                                                    class="form-control {{ $errors->has("email") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="email" id="email" placeholder="Please enter email"
                                                    maxlength="191"
                                                    value="{{old('email')}}">

                                                <span class="form-text text-danger"
                                                      id="error_email">{{ $errors->getBag('default')->first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="contact_no">Contact No.</label>
                                                <input
                                                    class="form-control {{ $errors->has("contact_no") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="contact_no" id="contact_no" placeholder="Please enter contact_no"
                                                    maxlength="191"
                                                    value="{{old('contact_no')}}">

                                                <span class="form-text text-danger"
                                                      id="error_contact_no">{{ $errors->getBag('default')->first('contact_no') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="address">Address</label>
                                                <textarea
                                                    class="form-control {{ $errors->has("address") ? 'is-invalid' : '' }}"
                                                    name="address" id="address" placeholder="Please enter address">{{old('address')}}</textarea>

                                                <span class="form-text text-danger"
                                                      id="error_address">{{ $errors->getBag('default')->first('address') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="join_date">Joining Date </label>
                                               <input
                                                    class="form-control {{ $errors->has("join_date") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="join_date" id="join_date" placeholder="Please enter join_date"
                                                    maxlength="191"
                                                    value="{{old('join_date')}}">

                                                <span class="form-text text-danger"
                                                      id="error_join_date">{{ $errors->getBag('default')->first('join_date') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="appraisal_date">First Appraisal Date </label>
                                               <input
                                                    class="form-control {{ $errors->has("appraisal_date") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="appraisal_date" id="appraisal_date" placeholder="Please enter appraisal date"
                                                    maxlength="191"
                                                    value="{{old('appraisal_date')}}">

                                                <span class="form-text text-danger"
                                                      id="error_appraisal_date">{{ $errors->getBag('default')->first('appraisal_date') }}</span>
                                            </div>
                                        </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="birth">Birthday</label>
                                               <input
                                                    class="form-control {{ $errors->has("birth") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="birth" id="birth" placeholder="Please enter birth"
                                                    maxlength="191"
                                                    value="{{old('birth')}}">

                                                <span class="form-text text-danger"
                                                      id="error_birth">{{ $errors->getBag('default')->first('birth') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="">
                                            Cancel </a>
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
    <script>
        $(function () {
            $("#join_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });
             $("#appraisal_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });
            $("#birth").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });
            $('#addempForm').validate({
                rules: {
                    category: {
                        required: true
                    },
                    name: {
                        required: true,
                    },
                    email: {
                        required: true
                    },
                    contact_no: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    join_date: {
                        required: true
                    },
                    appraisal_date: {
                        required: true
                    },
                    birth: {
                        required: true
                    },
                },
                messages: {
                    category: {
                        required: "This category name field is required.",
                    },
                    name: {
                        required: "This name field is required.",
                    },
                    email: {
                        required: "This email field is required.",
                    },
                    contact_no: {
                        required: "This contact number field is required.",
                    },
                    address: {
                        required: "This address field is required.",
                    },
                    join_date: {
                        required: "This join date field is required.",
                    },
                    appraisal_date: {
                        required: "This appraisal date field is required.",
                    },
                    birth: {
                        required: "This birth field is required.",
                    },

                },
                errorElement: "span",
                errorClass: "form-text text-danger is-invalid"
            });
            $('#addempForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });
        });
    </script>
@endsection
