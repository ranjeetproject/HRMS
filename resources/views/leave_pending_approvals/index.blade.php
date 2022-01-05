@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Pending Approvals</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fab fa-penny-arcade"></i>
                                    Leave Pending Approvals</a></li>
                            <li class="breadcrumb-item active"></li>
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
                                <h3 class="card-title"><i class="fas fa-align-justify"></i> Pending Applications</h3>
                                {{-- <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}" style="float:right">
                                            Back </a> --}}
                            </div>
                            <span id="success-message" style="color:#ed0f12;padding:10px;margin-left:90%;"></span>
                                    <div class="card-body">
                                        <div class="row mt-4">
                                            <div class="col">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="employee_table">
                                                        <tbody>
                                                            <thead>
                                                                    <tr>
                                                                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                                        <th>Application Type</th>
                                                                        <th>Applicant Name</th>
                                                                        <th>From Date</th>
                                                                        <th>To Date</th>
                                                                        <th>Status</th>
                                                                        <th>Reason</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    @foreach($appliedLeaves as $appliedLeave)
                                                                    <tr>
                                                                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                                        @if($appliedLeave->application_type == 1)
                                                                            <th>Full Day Leave</th>
                                                                        @elseif($appliedLeave->application_type == 2)
                                                                            <th>Half Day Leave</th>
                                                                        @elseif($appliedLeave->application_type == 3)
                                                                            <th>Extra Day Worked</th>
                                                                        @elseif($appliedLeave->application_type == 4)
                                                                            <th>Work From Home</th>
                                                                        @else
                                                                            <th>Work From Office</th>
                                                                        @endif
                                                                        <th>{{$appliedLeave->name}}</th>
                                                                        <th>{{date('d-m-Y', strtotime($appliedLeave->from_date))}}</th>
                                                                        <th>{{date('d-m-Y', strtotime($appliedLeave->to_date))}}</th>
                                                                        @if($appliedLeave->status == 0)
                                                                            <th>Pending</th>
                                                                        @elseif($appliedLeave->status == 1)
                                                                            <th>Approved</th>
                                                                        @else
                                                                            <th>Rejected</th>
                                                                        @endif
                                                                        <th>{{$appliedLeave->reason}}</th>
                                                                        <th>
                                                                            <div class="card-footer" style="padding:0px;background-color:white">
                                                                                <div class="col text-center">
                                                                                    <a class="btn btn-primary" href="javascript:void(0)"  onclick="event.preventDefault(); changeStatus(1,{{$appliedLeave->id}},{{$appliedLeave->application_type}},'{{$appliedLeave->from_date}}','{{$appliedLeave->to_date}}',{{$appliedLeave->usersId}})">
                                                                                        Approved </a>&nbsp;&nbsp;&nbsp;
                                                                                    <a class="btn btn-danger" href="#" onclick="changeStatus(2,{{$appliedLeave->id}},{{$appliedLeave->application_type}},{{$appliedLeave->usersId}})">
                                                                                        Rejected </a>
                                                                                </div>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                    @endforeach
                                                            </thead>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        {{-- <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}">
                                            Cancel </a>
                                        <button type="submit" class="btn btn-primary"> Submit</button> --}}
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJsInclude')
    <script>
    function changeStatus(btn_id,leave_application_id,leave_application_type = null,from_date=null,to_date=null,user_id = null){
            var btn_id = btn_id;
            var leave_application_id = leave_application_id;
            var leave_application_type = leave_application_type;
            var from_date = from_date;
            var to_date = to_date;
            var user_id = user_id;

            var dataValue = {
                        btn_id: btn_id,
                        leave_application_id:leave_application_id,
                        leave_application_type:leave_application_type,
                        from_date:from_date,
                        to_date:to_date,
                        user_id:user_id,
                    }

            var baseUrl = '{{action("PendingApprovalController@approveAndRejectedLeave")}}';
                    $.ajax({
                        type: 'GET',
                        url: baseUrl,
                        data: dataValue,
                        success: function (data)
                        {
                            if (data.success == true) {
                                 $("#success-message").html(data.message);
                                setTimeout(function () {
                                    $("#success-message").html('');
                                }, 100000);
                                location.reload();

                           }else{
                               $("#success-message").html(data.message);
                              setTimeout(function () {
                                    $("#success-message").html('');
                                }, 100000);
                                location.reload();
                           }
                        }
                    });
    }
    </script>
@endsection