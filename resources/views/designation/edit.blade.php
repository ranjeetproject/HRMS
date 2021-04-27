@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Edit Designation</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fab fa-dyalog"></i> Edit Designation</li>
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
                                   Edit Designation
                                </div>
                            </div>
                            <form action="{{action('DesignationController@update',[$designation->id])}}" method="post"
                                  enctype="multipart/form-data" id="designationForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="designation_name">Designation Name <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input class="form-control {{ $errors->has('designation_name') ? 'is-invalid' : '' }}"
                                                    type="text" name="designation_name" id="designation_name" placeholder="Please enter designation name"
                                                    maxlength="191" value="{{old('designation_name',$designation->designation_name)}}">
                                                <span class="form-text text-danger"
                                                      id="error_designation_name">{{ $errors->getBag('default')->first('designation_name') }}</span>
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