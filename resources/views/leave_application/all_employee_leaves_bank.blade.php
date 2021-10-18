@extends('layouts.app')

@section('content')
            

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>All Employees Leaves Details</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href=""> <i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa fa-check"></i>&nbsp;All Employees Leaves Details</li>
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
                            <h3 class="card-title">
                                <i class="fas fa-align-justify"></i>
                                All Employees Leaves Details
                            </h3>
                            {{-- <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                                <a href="{{action('RecruitmentController@create')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><span>Create New</span> <i class="fas fa-plus-circle"></i></a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col">
                                <style>
                                .form-control {
                                    width:25%;
                                }
                                </style>
                                     <form role="form" action="{{action('LeaveApplicationController@MonthAndYearWiseLeaves')}}" 
                                        method="POST" id="addReqForm">
                                     @csrf
                                        <select class="form-control form-control-sm" id="monthAndYear" name="monthAndYear">
                                            <option value="">Select Months</option>
                                            @foreach ($yearsMonths as $yearandmonth)
                                                <option value="{{$yearandmonth['month_number']}} {{$yearandmonth['year']}}">{{$yearandmonth['month']}} {{$yearandmonth['year']}}</option>
                                            @endforeach
                                        </select><br>
                                        <button type="submit" class="btn btn-primary"> Submit</button>
                                    </form><br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="employee_table">
                                             <tbody>
                                                <thead>
                                                    <tr>
                                                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                        <th>Name Of Employee</th>
                                                        <th>Total Work Days</th>
                                                        <th>Total Working Days</th>
                                                        <th>Numbers Offs</th>
                                                        <th>Numbers of Approved Leaves</th>
                                                        <th>Numbers of Approved ExtraDay Working</th>
                                                        <th>Numbers of Approved HalfDays Working</th>
                                                        <th>Salary Deductions</th>
                                                    </tr>
                                                    @foreach ($employee_leaves_data as $val)
                                                    </tr>
                                                        <td>{{$val['employee_name']}}</td>
                                                        <td>{{$val['twd']}}</td>
                                                        <td>{{$val['totalworkingdays']}}</td>
                                                        <td>{{$val['numberoffs']}}</td>
                                                        <td>{{$val['numberapprove']}}</td>
                                                        <td>{{$val['extra_work']}}</td>
                                                        <td>{{$val['half_day_work']}}</td>
                                                        <td>{{$val['salary_deduction']}}</td>
                                                    </tr>  
                                                    @endforeach
                                                </thead>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div><!--row-->
                        </div><!--card-body-->
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@section('customJsInclude')
<script>
    $(function() {
        
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
     }  
    
    $('#addReqForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 5000);
            });
    });

        
        
        

            
        

            
        
        


</script>

@endsection
