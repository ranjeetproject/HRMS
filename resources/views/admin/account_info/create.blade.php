@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5> Account-Info  Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('LoginController@getAdminDashboard')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{action('AccountInfoController@index')}}"><i class="fa fa-pray"></i>
                                     Account-Info </a></li>
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
                            <form role="form" action="{{action('AccountInfoController@store')}}" method="POST"
                                  enctype="multipart/form-data" id="addempaccForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="payee_id">Payee ID</label>
                                               
                                               <input
                                                    class="form-control {{ $errors->has("payee_id") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="payee_id" id="payee_id" placeholder="Please enter payee_id"
                                                    maxlength="191"
                                                    value="{{old('payee_id')}}">
                                                <span class="form-text text-danger"
                                                      id="error_payee_id">{{ $errors->getBag('default')->first('payee_id') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="user_id">Payee Name</label>
                                                <select
                                                    class="form-control custom-select {{ $errors->has("user_id") ? 'is-invalid' : '' }}"
                                                    name="user_id" id="user_id">
                                                    <option value="">Select One</option>
                                                   @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="error_user_id">{{ $errors->getBag('default')->first('user_id') }}
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
                                                <label class=" form-control-label" for="designation">Designation</label>
                                                <input
                                                    class="form-control {{ $errors->has("designation") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="designation" id="designation" placeholder="Please enter designation"
                                                    maxlength="191"
                                                    value="{{old('designation')}}">

                                                <span class="form-text text-danger"
                                                    id="error_designation">{{ $errors->getBag('default')->first('designation') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="join_date">Date Of Joining</label>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="pan_no">pan_no</label>
                                                    <input
                                                        class="form-control {{ $errors->has("pan_no") ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="pan_no" id="pan_no" placeholder="Please enter pan_no number"
                                                        maxlength="191"
                                                        value="{{old('pan_no')}}">

                                                    <span class="form-text text-danger"
                                                        id="error_pan_no">{{ $errors->getBag('default')->first('pan_no') }}</span>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="account_no">Bank A/c No. </label>
                                               <input
                                                    class="form-control {{ $errors->has("account_no") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="account_no" id="account_no" placeholder="Please enter bank account No."
                                                    maxlength="191"
                                                    value="{{old('account_no')}}">

                                                <span class="form-text text-danger"
                                                      id="error_account_no">{{ $errors->getBag('default')->first('account_no') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="gross_payout">Gross Payout</label>
                                                <input
                                                    class="form-control {{ $errors->has("gross_payout") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="gross_payout" id="gross_payout" placeholder="Please enter gross payout"
                                                    maxlength="191"
                                                    value="{{old('gross_payout')}}">

                                                <span class="form-text text-danger"
                                                      id="error_gross_payout">{{ $errors->getBag('default')->first('gross_payout') }}</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="deduction_for_absent">Deduction For Absent </label>
                                               <input
                                                    class="form-control {{ $errors->has("deduction_for_absent") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="deduction_for_absent" id="deduction_for_absent" placeholder="Please enter deduction for absent"
                                                    maxlength="191"
                                                    value="{{old('deduction_for_absent')}}">

                                                <span class="form-text text-danger"
                                                      id="error_deduction_for_absent">{{ $errors->getBag('default')->first('deduction_for_absent') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="tds">TDS</label>
                                                <input
                                                    class="form-control {{ $errors->has("tds") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="tds" id="tds" placeholder="Please enter tds number"
                                                    maxlength="191"
                                                    value="{{old('tds')}}">

                                                <span class="form-text text-danger"
                                                      id="error_tds">{{ $errors->getBag('default')->first('tds') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="loan">	Loan </label>
                                               <input
                                                    class="form-control {{ $errors->has("loan") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="loan" id="loan" placeholder="Please enter bank account No."
                                                    maxlength="191"
                                                    value="{{old('loan')}}">

                                                <span class="form-text text-danger"
                                                      id="error_loan">{{ $errors->getBag('default')->first('loan') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="gross_deduction">Gross Deduction</label>
                                                <input
                                                    class="form-control {{ $errors->has("gross_deduction") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="gross_deduction" id="gross_deduction" placeholder="Please enter gross_deduction number"
                                                    maxlength="191"
                                                    value="{{old('gross_deduction')}}">

                                                <span class="form-text text-danger"
                                                      id="error_gross_deduction">{{ $errors->getBag('default')->first('gross_deduction') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" form-control-label" for="net_pay">Total Net Pay </label>
                                               <input
                                                    class="form-control {{ $errors->has("net_pay") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="net_pay" id="net_pay" placeholder="Please enter bank account No."
                                                    maxlength="191"
                                                    value="{{old('net_pay')}}">

                                                <span class="form-text text-danger"
                                                      id="error_net_pay">{{ $errors->getBag('default')->first('net_pay') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="{{action('AccountInfoController@index')}}">
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
             
            $('#addempaccForm').validate({
                rules: {
                    payee_id: {
                        required: true
                    },
                    payee_name: {
                        required: true,
                    },
                    email: {
                        required: true
                    },
                    designation: {
                        required: true
                    },
                    join_date: {
                        required: true
                    },
                    pan: {
                        required: true
                    },
                    bank_account: {
                        required: true
                    },
                    gross_payout: {
                        required: true
                    },
                    deduction_for_absent: {
                        required: true
                    },
                    tds: {
                        required: true
                    },
                    loan: {
                        required: true
                    },
                     gross_deduction: {
                        required: true
                    },
                     net_pay: {
                        required: true
                    },
                },
                messages: {
                    payee_id: {
                        required: "This payee id field is required.",
                    },
                    payee_name: {
                        required: "This name field is required.",
                    },
                    email: {
                        required: "This email field is required.",
                    },
                    designation: {
                        required: "This designation field is required.",
                    },
                    join_date: {
                        required: "This  join date field is required.",
                    },
                    pan: {
                        required: "This pan field is required.",
                    },
                    bank_account: {
                        required: "This bank account field is required.",
                    },
                    gross_payout: {
                        required: "This gross payout field is required.",
                    },
                    deduction_for_absent: {
                        required: "This deduction for absent field is required.",
                    },
                     tds: {
                        required: "This tds field is required.",
                    },
                    loan: {
                        required: "This loan field is required.",
                    },
                    gross_deduction: {
                        required: "This gross deduction field is required.",
                    },
                    net_pay: {
                        required: "This net pay field is required.",
                    },

                },
                errorElement: "span",
                errorClass: "form-text text-danger is-invalid"
            });
            $('#addempaccForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });
        });
    </script>
@endsection
