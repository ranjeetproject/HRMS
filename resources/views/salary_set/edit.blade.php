@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Salary Set Up Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-money-bill-alt"></i>
                                    Salary Set Up</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                                <a class="btn btn-danger" href="{{action('SalarySetUpController@index')}}" style="float:right">
                                            Back </a>
                            </div>
                            <form role="form" action="{{action('SalarySetUpController@update',[@$salary_set_up_edit->id])}}" method="POST"
                                  enctype="multipart/form-data" id="addReqForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input
                                                class="form-control"
                                                type="hidden"
                                                name="recruitment_id" id="recruitment_id" value="{{@$salary_set_up_edit->recruitment_id}}">
                                                <input
                                                class="form-control"
                                                type="hidden"
                                                name="employee_details_id" id="employee_details_id" value="{{$salary_set_up_edit->employee_details_id}}">
                                               <label class="form-control-label" for="employee_id">Employee Name</label>
                                               
                                                @if(@$salary_set_up_edit->recruitment->name_of_candidate)
                                                    <input
                                                        class="form-control {{ $errors->has('employee_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="employee_name" id="employee_name" placeholder="Please enter employee name"
                                                        maxlength="191"
                                                        value="{{old('employee_name',@$salary_set_up_edit->recruitment->name_of_candidate)}}" readonly>
                                                @else
                                                    <input
                                                        class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="name_of_candidate" id="name_of_candidate" placeholder="Please enter employee name"
                                                        maxlength="191"
                                                        value="{{old('name_of_candidate',$salary_set_up_edit->name_of_candidate)}}" readonly>
                                                @endif
                                                <span class="form-text text-danger"
                                                      id="error_employee_name">{{ $errors->getBag('default')->first('employee_name') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="employee_code">Employee ID</label>
                                                 <input
                                                    class="form-control {{ $errors->has('employee_code') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="employee_code" id="employee_code" placeholder="Please enter employee code"
                                                    maxlength="191"
                                                    value="{{old('employee_code',$salary_set_up_edit->employee_code)}}" readonly>
                                                
                                                <span class="form-text text-danger"
                                                      id="error_employee_code">{{ $errors->getBag('default')->first('employee_code') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="email_id">Email ID</label>
                                                <input
                                                    class="form-control {{ $errors->has('email_id') ? 'is-invalid' : '' }}"
                                                    type="email"
                                                    name="email_id" id="email_id" placeholder="Please enter email id"
                                                    maxlength="191"
                                                    value="{{old('email_id',$salary_set_up_edit->email_id)}}" readonly>
                                                <span class="form-text text-danger"
                                                      id="error_email_id">{{ $errors->getBag('default')->first('email_id') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="salary_type">Salary Type</label>
                                                    <select
                                                        class="form-control custom-select {{ $errors->has("salary_type") ? 'is-invalid' : '' }}"
                                                        name="salary_type" id="salary_type">
                                                        <option value="">Select</option>
                                                        <option value="with pf"  @if(@$salary_set_up_edit->salary_type=='with pf') selected @endIf>With PF</option>
                                                        <option value="without PF" @if(@$salary_set_up_edit->salary_type=='without PF') selected @endIf>WithOut PF</option>
                                                        <option value="contractual" @if(@$salary_set_up_edit->salary_type=='contractual') selected @endIf>Contractual</option>
                                                    </select>
                                                <span class="form-text text-danger"
                                                      id="error_salary_type">{{ $errors->getBag('default')->first('salary_type') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label class="form-control-label" for="gross_salary">Gross Salary</label>
                                                    <input
                                                        class="form-control {{ $errors->has('gross_salary') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="gross_salary" id="gross_salary" placeholder="Please enter gross salary"
                                                        maxlength="191"
                                                        value="{{old('gross_salary',@$salary_set_up_edit->gross_salary)}}">
                                                
                                                <span class="form-text text-danger"
                                                      id="error_gross_salary">{{ $errors->getBag('default')->first('gross_salary') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class=" form-control-label" for="allowances">Allowances</label>
                                        <div class="col-md-12 border border-dark">
                                            <div class="row container-sm">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="ctc">CTC</label>
                                                            <input
                                                                    class="form-control {{ $errors->has('ctc') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="ctc" id="ctc" placeholder="Please enter ctc"
                                                                    maxlength="191"
                                                                    value="{{old('ctc',@$salary_set_up_edit->ctc)}}">
                                                        <span class="form-text text-danger"
                                                            id="error_ctc">{{ $errors->getBag('default')->first('ctc') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="basic">Basic</label>
                                                        
                                                            <input
                                                                class="form-control {{ $errors->has('basic') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="basic" id="basic" placeholder="Please enter basic"
                                                                maxlength="191"
                                                                value="{{old('basic',@$salary_set_up_edit->basic)}}">
                                                       
                                                        <span class="form-text text-danger"
                                                            id="error_basic">{{ $errors->getBag('default')->first('basic') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="hra">HRA</label>
                                                            <input
                                                                class="form-control {{ $errors->has('hra') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="hra" id="hra" placeholder="Please enter hra"
                                                                maxlength="191"
                                                                value="{{old('hra',@$salary_set_up_edit->hra)}}">
                                                       
                                                        <span class="form-text text-danger"
                                                            id="error_hra">{{ $errors->getBag('default')->first('hra') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="other_allowances">Other Allowances</label>
                                                        
                                                            <input
                                                                class="form-control {{ $errors->has('other_allowances') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="other_allowances" id="other_allowances" placeholder="Please enter other allowances"
                                                                maxlength="191"
                                                                value="{{old('other_allowances',@$salary_set_up_edit->other_allowances)}}">
                                                      
                                                        <span class="form-text text-danger"
                                                            id="error_other_allowances">{{ $errors->getBag('default')->first('other_allowances') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label class=" form-control-label" for="deductions">Deductions</label>
                                        <div class="col-md-12 border border-dark">
                                            <div class="row container-sm">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="epf">EPF</label>
                                                        
                                                            <input
                                                                    class="form-control {{ $errors->has('epf') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="epf" id="epf" placeholder="Please enter epf"
                                                                    maxlength="191"
                                                                    value="{{old('epf',@$salary_set_up_edit->epf)}}">
                                                                    
                                                        <span class="form-text text-danger"
                                                            id="error_epf">{{ $errors->getBag('default')->first('epf') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="esi">ESI</label>
                                                            <input
                                                                class="form-control {{ $errors->has('esi') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="esi" id="esi" placeholder="Please enter esi"
                                                                maxlength="191"
                                                                value="{{old('esi',@$salary_set_up_edit->esi)}}">
                                                       
                                                        <span class="form-text text-danger"
                                                            id="error_esi">{{ $errors->getBag('default')->first('esi') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="p_tax">P TAX</label>
                                                            <input
                                                                class="form-control {{ $errors->has('p_tax') ? 'is-invalid' : '' }}"
                                                                type="text"
                                                                name="p_tax" id="p_tax" placeholder="Please enter p tax"
                                                                maxlength="191"
                                                                value="{{old('p_tax',@$salary_set_up_edit->p_tax)}}">
                                                       
                                                        <span class="form-text text-danger"
                                                            id="error_p_tax">{{ $errors->getBag('default')->first('p_tax') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" for="tds">TDS</label>
                                                        
                                                            <input
                                                                    class="form-control {{ $errors->has('tds') ? 'is-invalid' : '' }}"
                                                                    type="text"
                                                                    name="tds" id="tds" placeholder="Please enter tds"
                                                                    maxlength="191"
                                                                    value="{{old('tds',@$salary_set_up_edit->tds)}}">
                                                       
                                                        <span class="form-text text-danger"
                                                            id="error_tds">{{ $errors->getBag('default')->first('tds') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="{{action('SalarySetUpController@index')}}">
                                            Cancel </a>
                                       
                                           <button type="submit" class="btn btn-primary" > Update</button>
                                        
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
            $("#gross_salary").on("keyup", function(){
                var grossSalary = $(this).val();
                if(grossSalary){
                    var dataValue = {
                        gross_salary: grossSalary,
                    }
                    var baseUrl = '{{action("SalarySetUpController@fetchGrossSalary")}}';
                    $.ajax({
                        type: 'GET',
                        url: baseUrl,
                        data: dataValue,
                        success: function (data)
                        {
                           if (data.success == true) {
                               $("#ctc").val(data.salary.ctc)
                               $("#basic").val(data.salary.basic)
                               $("#hra").val(data.salary.hra)
                               $("#other_allowances").val(data.salary.other_allowance)
                           }
                        }
                    });
                }
                
            });
            $('#addReqForm').validate({
                rules: {
                    salary_type: {
                        required: true
                    },
                    gross_salary: {
                        required: true,
                    },
                    epf: {
                        required: true
                    },
                    esi: {
                        required: true
                    },
                    p_tax: {
                        required: true
                    },
                    tds: {
                        required: true
                    },
                },
                messages: {
                    salary_type: {
                        required: "This salary type field is required.",
                    },
                    gross_salary: {
                        required: "This gross salary field is required.",
                    },
                    epf: {
                        required: "This epf field is required.",
                    },
                    esi: {
                        required: "This esi field is required.",
                    },
                    p_tax: {
                        required: "This cp tax field is required.",
                    },
                    tds: {
                        required: "This tds field is required.",
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
