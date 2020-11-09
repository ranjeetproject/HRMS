@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Category Magement</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('LoginController@getAdminDashboard')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{action('CategoryController@index')}}"><i class="fa fa-pray"></i>
                                    Category</a></li>
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
                            </div>
                            <form role="form" action="{{action('CategoryController@update',[$category->id])}}" method="POST"
                                   id="categoryForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="cname">Category Name</label>
                                                <input
                                                    class="form-control {{ $errors->has("cname") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="cname" id="cname" placeholder="Please enter category name"
                                                    value="{{old('cname',$category->cname)}}">
                                                <span class="form-text text-danger"
                                                      id="error_cname">{{ $errors->getBag('default')->first('cname') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="{{action('CategoryController@index')}}">
                                            Cancel </a>
                                        <button type="submit" class="btn btn-primary"> Update</button>
                                    </div>
                                </div>
                                {{method_field('PATCH')}}
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
            $('#categoryForm').validate({
                rules: {
                    cname: {
                        required: true
                    },
                },
                messages: {
                    cname: {
                        required: "This category name field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger is-invalid"
            });
            $('#categoryForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });


        });
    </script>
@endsection
