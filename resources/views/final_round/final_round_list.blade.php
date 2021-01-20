@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Final Round Management</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href=""> <i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa-user-check"></i></i> Final  Round</li>
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
                                Final Round List 
                            </h3>
                            <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                                <!-- <a href="{{action('RecruitmentController@create')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><span>Create New</span> <i class="fas fa-plus-circle"></i></a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="final_round_table">
                                            <thead>
                                            <tr>
                                                <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                <th>ID</th>
                                                <th>Name Of Candidate</th>
                                                <th>Email</th>
                                                <th>Mobile Number</th>
                                                <th>Interview Date</th>
                                                <th>Interview Time</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
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
    <script type="text/javascript">
        var baseUrl = '{{asset('/')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            table = $('#final_round_table').DataTable({
                createdRow: function (row, data) {
                    $(row).attr('data-entry-id', data.id);
                },
                processing: false,
                serverSide: true,
                dom: 'lBfrtip<"actions">',
                ajax: {
                    url: baseUrl + 'final-round',
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
                    {data: 'name_of_candidate', name: 'name_of_candidate', orderable: true},
                    {data: 'email_id', name: 'email_id', orderable: true},
                    {data: 'mobile_number', name: 'mobile_number', orderable: true},
                    {data: 'final_round_interview_scheduling_date', name: 'final_round_interview_scheduling_date', orderable: true},
                    {data: 'final_round_interview_scheduling_time', name: 'final_round_interview_scheduling_time', orderable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: false}
                ]
            });
        });
    </script>
@endsection
