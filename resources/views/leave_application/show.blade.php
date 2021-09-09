@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5> Leave Application Management</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-chalkboard-teacher"></i>
                                     Leave Application</a></li>
                            <li class="breadcrumb-item active"> View</li>
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
                                <h3 class="card-title"><i class="fas fa-eye "></i> View</h3>
                                <a class="btn btn-danger" href="{{action('LeaveApplicationController@index')}}" style="float:right">
                                            Back </a>

                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th>From Date</th>
                                        <td>{{@$leaveData->from_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>To Date</th>
                                        <td>{{@$leaveData->to_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>Application Type</th>
                                        @if(@$leaveData->application_type==1)
                                             <td>Full Day Leave</td>
                                        @elseif(@$leaveData->application_type==2)
                                            <td>Half Day Leave</td>
                                        @elseif(@$leaveData->application_type==3)
                                            <td>Extra Day Worked</td>
                                        @elseif(@$leaveData->application_type==4)
                                            <td>Work From Home</td>
                                        @else
                                            <td>Work From Office</td>
                                        @endIf
                                    </tr>
                                    <tr>
                                        <th>Reason</th>
                                        <td>{{@$leaveData->reason}}</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection