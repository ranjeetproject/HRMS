@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Add Leave Bank</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-chalkboard-teacher"></i>Add Leave Bank</li>
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
                                     Add Leave Bank
                                </div>
                            </div>
                            <form action="{{action('LeavesBankController@store')}}" method="post"
                                  enctype="multipart/form-data" id="leavebankForm">
                                {{csrf_field()}}
                                <input
                                    class="form-control"
                                    type="hidden"
                                    name="date" id="date" value="{{date("Y-m-d")}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label" for="from_date">Employees<span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <select class="form-control custom-select {{ $errors->has("user_id") ? 'is-invalid' : '' }}"
                                                        name="user_id" id="user_id">
                                                        <option value="">Select</option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                                        @endforeach
                                                    </select>
                                                        <span class="form-text text-danger"
                                                            id="error_user_id">{{ $errors->getBag('default')->first('user_id') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label" for="number_of_leaves">Number Of Leaves <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input
                                                    class="form-control {{ $errors->has('number_of_leaves') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="number_of_leaves" id="number_of_leaves" placeholder="Please enter number of leaves"
                                                    maxlength="191"
                                                    value="{{old('number_of_leaves')}}">
                                                    <span class="form-text text-danger"
                                                        id="error_number_of_leaves">{{ $errors->getBag('default')->first('number_of_leaves') }}</span>
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
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="leave-bank">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Employee Name</th>
                                                    <th>Number Of Leaves</th>
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

             table = $('#leave-bank').DataTable({
                createdRow: function (row, data) {
                    $(row).attr('data-entry-id', data.id);
                },
                processing: false,
                serverSide: true,
                dom: 'lBfrtip<"actions">',
                ajax: {
                    url: baseUrl + 'add-leaves-bank',
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
                    {data:'date', name:'date', orderable: true},
                    {data: 'name', name: 'name', orderable: true},
                    {data: 'number_of_leaves', name: 'number_of_leaves', orderable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: false}
                ]
            });
            $('#leave-application').DataTable().ajax.reload()
            $('#leavebankForm').validate({
                rules: {
                    user_id: {
                        required: true
                    },
                    number_of_leaves: {
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
                    user_id: {
                        required: "This employees select field is required.",
                    },
                    number_of_leaves: {
                        required: "This number of leaves field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#leavebankForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
       


    </script>
@endsection


