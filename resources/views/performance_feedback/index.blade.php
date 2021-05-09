@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Performance Feedback</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-book-open"></i>&nbsp;Performance Feedback</li>
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
                                     Performance Feedback
                                </div>
                            </div>
                            <form action="{{action('PerformanceFeedbackController@store')}}" method="post"
                                  enctype="multipart/form-data" id="performanceFeedbackForm">
                                {{csrf_field()}}

                                <div class="row">
                                    <div class="col-md-3">
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div>
                                                    <label class="col-md-2 form-control-label" for="team_member_name_id" style="display:inline">Team Member Name<span class="text-danger">*</span></label>
                                                </div><br><br>
                                                <div class="col-md-10">
                                                   <select
                                                        class="form-control custom-select {{ $errors->has("team_member_name_id") ? 'is-invalid' : '' }}"
                                                        name="team_member_name_id" id="team_member_name_id">
                                                        <option value="">Select</option>
                                                        @foreach ($team_member_name as $member_name)
                                                            <option value="{{$member_name->members}}">{{$member_name->name}}</option>
                                                        @endforeach
                                                       
                                                    </select>
                                                    <span class="form-text text-danger"
                                                        id="error_team_member_name_id">{{ $errors->getBag('default')->first('team_member_name_id') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        
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
                                    <div class="col-md-2">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                {{-- 
                                                <label class="col-md-2 form-control-label" for="performance_type">Extraordinary Performance <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                     <input type="radio" class="form-check-input" name="performance_type" id="released" value="1" style="margin-left:3%">
                                                </div> --}}
                                                <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                        <label class=" form-control-label" for="performance_type">Extraordinary Performance <span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                             <input type="radio" class="form-check-input" name="performance_type" id="released" value="1" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                {{-- <label class="col-md-2 form-control-label" for="performance_type">Client Testimonials<span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                     <input type="radio" class="form-check-input" name="performance_type" id="released" value="2" style="margin-left:3%">
                                                </div> --}}

                                                <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                        <label class="form-control-label" for="performance_type">Client Testimonials<span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                         <input type="radio" class="form-check-input" name="performance_type" id="released" value="2" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                {{-- 
                                                <label class="col-md-2 form-control-label" for="performance_type">Received GEM<span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                     <input type="radio" class="form-check-input" name="performance_type" id="released" value="3" style="margin-left:3%">
                                                </div> --}}

                                                <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                            <label class="form-control-label" for="performance_type">Received GEM<span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                            <input type="radio" class="form-check-input" name="performance_type" id="released" value="3" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-2">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                {{-- 
                                                <label class="col-md-2 form-control-label" for="performance_type">Poor performance<span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                     <input type="radio" class="form-check-input" name="performance_type" id="released" value="4" style="margin-left:3%">
                                                </div> --}}

                                                <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                        <label class="form-control-label" for="performance_type">Poor performance<span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                            <input type="radio" class="form-check-input" name="performance_type" id="released" value="4" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-md-2">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                {{-- 
                                                <label class="col-md-2 form-control-label" for="performance_type">Client Escallation<span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                     <input type="radio" class="form-check-input" name="performance_type" id="released" value="5" style="margin-left:3%">
                                                    <span class="form-text text-danger"
                                                        id="error_performance_type">{{ $errors->getBag('default')->first('performance_type') }}</span>
                                                </div> --}}

                                                 <div class="col-md-12">
                                                    <div class="inp_redio_wrap" >
                                                <label class="form-control-label" for="performance_type">Client Escallation<span class="text-danger">*</span></label>
                                                        <div class="inpredio">
                                                     <input type="radio" class="form-check-input" name="performance_type" id="released" value="5" style="margin-left:3%">
                                                        </div>
                                                    </div>
                                                                                                        <span class="form-text text-danger"
                                                        id="error_performance_type">{{ $errors->getBag('default')->first('performance_type') }}</span>

                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label" for="review_date">Review Date <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input
                                                    class="form-control {{ $errors->has('review_date') ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="review_date" id="review_date" placeholder="Please enter review date"
                                                    maxlength="191"
                                                    value="{{old('review_date')}}">
                                                    <span class="form-text text-danger"
                                                        id="error_review_date">{{ $errors->getBag('default')->first('review_date') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label" for="description">Description/Details <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <textarea
                                                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                                    name="description" id="description" placeholder="Please enter description">{{old('description')}}</textarea>
                                                    <span class="form-text text-danger"
                                                        id="error_description">{{ $errors->getBag('default')->first('description') }}</span>
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
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="performance-feedback">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>ID</th>
                                                    <th>Employee Name</th>
                                                    <th>Performance Type</th>
                                                    <th>Review Date</th>
                                                    <th>Description</th>
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

            $("#review_date").datepicker({
                dateFormat: "dd-mm-yy",
                minDate: new Date()
            });
            
             table = $('#performance-feedback').DataTable({
                createdRow: function (row, data) {
                    $(row).attr('data-entry-id', data.id);
                },
                processing: false,
                serverSide: true,
                dom: 'lBfrtip<"actions">',
                ajax: {
                    url: baseUrl + 'performance-feedback',
                    data: function (d) {
                    }
                },
                retrieve: true,
                columnDefs: [
                    {"className": "dt-center", "targets": [0,1,2,3,4,5]}
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
                    {data: 'name', name: 'name', orderable: true},
                    {data: 'performance_type', name: 'performance_type', orderable: true},
                    {data: 'review_date', name: 'review_date', orderable: true},
                    {data: 'description', name: 'description', orderable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: false}
                ]
            });
            $('#leave-application').DataTable().ajax.reload()

            $('#performanceFeedbackForm').validate({
                rules: {
                    team_member_name_id: {
                        required: true
                    },
                    performance_type: {
                        required: true
                    },
                    leave_apply_type: {
                        required: true
                    },
                    review_date: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    
                },
                messages: {
                    team_member_name_id: {
                        required: "This team member name field is required.",
                    },
                    performance_type: {
                        required: "This to performance type field is required.",
                    },
                    review_date: {
                        required: "This review date field is required.",
                    },
                    description: {
                        required: "This description field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#performanceFeedbackForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
       


    </script>
@endsection


