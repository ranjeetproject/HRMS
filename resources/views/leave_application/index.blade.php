@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Leave Application</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-chalkboard-teacher"></i>Leave Application</li>
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
                                     Leave Application
                                </div>
                            </div>
                            <form action="{{action('LeaveApplicationController@store')}}" method="post"
                                  enctype="multipart/form-data" id="leaveForm">
                                {{csrf_field()}}
                                <input
                                    class="form-control"
                                    type="hidden"
                                    name="manager_id" id="manager_id" value="{{@$employees_manager->user_id}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label" for="from_date">From Date <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                        <input class="form-control {{ $errors->has('from_date') ? 'is-invalid' : '' }}"
                                                        type="text" name="from_date" id="from_date" placeholder="Please enter from date"
                                                        maxlength="191" value="{{old('from_date')}}" autocomplete="off">
                                                    <span class="form-text text-danger"
                                                        id="error_from_date">{{ $errors->getBag('default')->first('from_date') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label" for="to_date">To Date<span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input class="form-control {{ $errors->has('to_date') ? 'is-invalid' : '' }}"
                                                        type="text" name="to_date" id="to_date" placeholder="Please enter to date"
                                                        maxlength="191" value="{{old('to_date')}}" autocomplete="off">
                                                    <span class="form-text text-danger"
                                                        id="error_to_date">{{ $errors->getBag('default')->first('to_date') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                    .inp_redio_wrap {
                                        display: flex;
                                        width: 100%;
                                        position: relative

                                    }

                                    .inp_redio_wrap .inpredio span {
                                    position: absolute;
                                    left: 0px;
                                    bottom: -27px;
                                    width: 179px;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                        <label class=" form-control-label" for="application_type">Full Day Leave <span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                            <input type="radio" class="form-check-input" name="application_type" id="released" value="1" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body">
                                            <div class="form-group row">
                                              <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                        <label class="form-control-label" for="application_type">Half Day Leave<span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                            <input type="radio" class="form-check-input" name="application_type" id="released" value="2" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                {{-- <label class="col-md-2 form-control-label" for="application_type">Extra Day Worked<span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                     <input type="radio" class="form-check-input" name="application_type" id="released" value="3" style="margin-left:3%">
                                                </div> --}}

                                                 <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                        <label class=" form-control-label" for="application_type">Extra Day Worked<span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                        <input type="radio" class="form-check-input" name="application_type" id="released" value="3" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                 <label class=" form-control-label" for="application_type">Work From Home<span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                     <input type="radio" class="form-check-input" name="application_type" id="released" value="4" style="margin-left:3%">
                                                    <span class="form-text text-danger"
                                                        id="error_application_type">{{ $errors->getBag('default')->first('application_type') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                        <label class=" form-control-label" for="application_type">Work From Office <span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                            <input type="radio" class="form-check-input" name="application_type" id="released" value="5" style="margin-left:3%">
                                                                <span class="form-text text-danger"
                                                                id="error_application_type">{{ $errors->getBag('default')->first('application_type') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label" for="reason">Reason for Application <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <textarea
                                                    class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}"
                                                    name="reason" id="reason" placeholder="Please enter reason">{{old('reason')}}</textarea>
                                                    <span class="form-text text-danger"
                                                        id="error_reason">{{ $errors->getBag('default')->first('reason') }}</span>
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
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fas fa-align-justify"></i>
                                    Leave Application
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="leave-application">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>ID</th>
                                                    <th>Application Type</th>
                                                    <th>Date From</th>
                                                    <th>Date To</th>
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

            $("#from_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });

            $("#to_date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                minDate: new Date()
            });
            
             table = $('#leave-application').DataTable({
                createdRow: function (row, data) {
                    $(row).attr('data-entry-id', data.id);
                },
                processing: false,
                serverSide: true,
                dom: 'lBfrtip<"actions">',
                ajax: {
                    url: baseUrl + 'leave-application',
                    data: function (d) {
                    }
                },
                retrieve: true,
                columnDefs: [
                    {"className": "dt-center", "targets": [0,1,2,3,4]}
                ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                "aaSorting": [],
                buttons: [
                    {
                        extend: 'csv',
                        text: window.csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: window.excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: window.pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: window.printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: window.colvisButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                orderCellsTop: true,
                fixedHeader: true,
                columns: [
                    /*{data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},*/
                    {data: 'id', name: 'id', orderable: true, searchable: true, visible: false},
                    {data: 'application_type', name: 'application_type', orderable: true},
                    {data: 'from_date', name: 'from_date', orderable: true},
                    {data: 'to_date', name: 'to_date', orderable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: false}
                ]
            });
            $('#leave-application').DataTable().ajax.reload()
            $('#leaveForm').validate({
                rules: {
                    from_date: {
                        required: true
                    },
                    to_date: {
                        required: true
                    },
                    leave_apply_type: {
                        required: true
                    },
                    reason: {
                        required: true
                    },
                    
                },
                messages: {
                    from_date: {
                        required: "This from date field is required.",
                    },
                    to_date: {
                        required: "This to date field is required.",
                    },
                    leave_apply_type: {
                        required: "This leave apply type field is required.",
                    },
                    reason: {
                        required: "This reason field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#leaveForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
       


    </script>
@endsection


