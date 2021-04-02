@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Skills Acquired</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-clipboard-list"></i> Skills Acquired</li>
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
                                    Skills Acquired
                                </div>
                            </div>
                            <form action="{{action('SkillsAcquiredController@store')}}" method="post"
                                  enctype="multipart/form-data" id="skill_acquireForm">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <ul class="list-group list-group-flush" style="overflow: auto;">
                                                            @foreach($skills as $skill)
                                                                <li class="list-group-item"> <input type="checkbox" class="form-check-input" name="skill[]" id="skill" value="{{$skill->id}}">{{$skill->skill_name}}</li>
                                                            @endforeach
                                                        </ul> 
                                                    <span class="form-text text-danger"
                                                        id="error_skill">{{ $errors->getBag('default')->first('skill') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class=" form-control-label" for="acquire_date">Acquired Date</label>
                                                <div class="form-group">
                                                        <input
                                                        class="form-control {{ $errors->has('acquire_date') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="acquire_date" id="acquire_date" placeholder="Please enter acquired date"
                                                        maxlength="191"
                                                        value="{{old('acquire_date')}}">
                                                    <span class="form-text text-danger"
                                                        id="error_acquire_date">{{ $errors->getBag('default')->first('acquire_date') }}</span>
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
                                    Skills Acquired
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="skills_acquired_table">
                                                <thead>
                                                <tr>
                                                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                    <th>ID</th>
                                                    <th>Skills Acquired</th>
                                                    <th>Date</th>
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
            
             table = $('#skills_acquired_table').DataTable({
                createdRow: function (row, data) {
                    $(row).attr('data-entry-id', data.id);
                },
                processing: false,
                serverSide: true,
                dom: 'lBfrtip<"actions">',
                ajax: {
                    url: baseUrl + 'skills-acquired',
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
                    {data: 'skill_name', name: 'skill_name', orderable: true},
                    {data: 'acquire_date', name: 'acquire_date', orderable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: false}
                ]
            });
            $("#acquire_date").datepicker();
            $('#skill_acquireForm').validate({
                rules: {
                    skill: {
                        required: true
                    },
                    acquire_date: {
                        required: true
                    },
                },
                messages: {
                    skill: {
                        required: "This skill field is required.",
                    },
                     acquire_date: {
                        required: "This acquire date field is required.",
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger"
            });


            $('#skill_acquireForm').submit(function(){
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function()
                {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
       


    </script>
@endsection


