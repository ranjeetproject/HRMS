@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Edit Department</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon far fa-building"></i> Edit Department</li>
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
                                   Edit Department
                                </div>
                            </div>
                            <form action="{{action('DepartmentController@update',[$department->id])}}" method="post"
                                  enctype="multipart/form-data" id="departmentForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="department_name">Department Name <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input class="form-control {{ $errors->has('department_name') ? 'is-invalid' : '' }}"
                                                    type="text" name="department_name" id="department_name" placeholder="Please enter department name"
                                                    maxlength="191" value="{{old('department_name',$department->department_name)}}">
                                                <span class="form-text text-danger"
                                                      id="error_department_name">{{ $errors->getBag('default')->first('department_name') }}</span>
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
            
            $('#departmentForm').validate({
                rules: {
                    department_name: {
                        required: true
                    },
                },
                messages: {
                    department_name: {
                        required: "This department name field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#departmentForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
       


    </script>
@endsection
