@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Holidays</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-gift"></i>&nbsp;&nbsp;Holidays</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
            @if(@$user_permissions->holiday_modify == '2')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fas fa-plus-square"></i>
                                   Holidays
                                </div>
                            </div>
                            <form action="{{action('HolidayController@store')}}" method="post"
                                   id="holidayForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class=" form-control-label" for="holiday_name">Holiday Name</label>
                                                <div class="form-group">
                                                    <input
                                                        class="form-control {{ $errors->has('holiday_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="holiday_name" id="holiday_name" placeholder="Please enter holiday name"
                                                        value="{{old('holiday_name')}}" autocomplete="off">
                                                    <span class="form-text text-danger"
                                                        id="error_holiday_name">{{ $errors->getBag('default')->first('holiday_name') }}</span>   
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class=" form-control-label" for="holiday_date">Holiday Date</label>
                                                <div class="form-group">
                                                        <input
                                                        class="form-control {{ $errors->has('holiday_date') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="holiday_date" id="holiday_date" placeholder="Please enter holiday date"
                                                        value="{{old('holiday_date')}}" autocomplete="off">
                                                    <span class="form-text text-danger"
                                                        id="error_holiday_date">{{ $errors->getBag('default')->first('holiday_date') }}</span>
                                                </div>
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
            @endIf
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fas fa-align-justify"></i>
                                    Holidays
                                </div>
                            </div>
                            <div class="card-body">
                            <style>
                                .form-control-sm {
                                    width:25%;
                                    
                                }
                                .dataTables_filter{
                                    display:none;
                                }
                                </style>
                                        <select class="form-control form-control-sm" id="monthAndYear" name="monthAndYear">
                                            <option value="">Select Months</option>
                                              @foreach ($yearsMonths as $yearandmonth)
                                                <option value="{{$yearandmonth['month']}} {{$yearandmonth['year']}}">{{$yearandmonth['month']}} {{$yearandmonth['year']}}</option>
                                            @endforeach
                                        </select>
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="holiday_table">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>ID</th>
                                                    <th>Holiday Name</th>
                                                    <th>Holiday Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
    <script type="text/javascript">
        var baseUrl = '{{asset('/')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $("#holiday_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
            });
                table = $('#holiday_table').DataTable({
                createdRow: function (row, data) {
                    $(row).attr('data-entry-id', data.id);
                    
                },
                processing: false,
                serverSide: true,
                bFilter: true,
                dom: 'lBfrtip<"actions">',
                ajax: {
                    url: baseUrl + 'holidays',
                    data: function (d) {
                    }
                },
                retrieve: true,
                columnDefs: [
                    {"className": "dt-center", "targets": [0,1,2]}
                ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                "aaSorting": [],
                buttons: [
                     'print'
                ],
                orderCellsTop: true,
                fixedHeader: true,
                columns: [
                    /*{data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},*/
                    {data: 'id', name: 'id', orderable: true, searchable: true, visible: false},
                    {data: 'holiday_name', name: 'holiday_name', orderable: true},
                    {data: 'monthName', name: 'monthName', orderable: true},
                    {data: 'action', name: 'action',searchable: false, orderable: true}
                ]
            });
            $('#monthAndYear').on('change', function(){
                table.search(this.value).draw();   
            });
            
            
            $('#holidayForm').validate({
                rules: {
                    holiday_name: {
                        required: true
                    },
                    holiday_date: {
                        required: true
                    },
                    
                },
                messages: {
                    holiday_name: {
                        required: "This holiday name field is required.",
                    },
                    holiday_date: {
                        required: "This holiday date field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#holidayForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });


        });
       


    </script>
@endsection