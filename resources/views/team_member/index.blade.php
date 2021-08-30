@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Team Member</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href=""> <i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa-users"></i>&nbsp; Team Members</li>
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
                                Team Members
                            </h3>
                            {{-- <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                                <a href="{{action('RecruitmentController@create')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><span>Create New</span> <i class="fas fa-plus-circle"></i></a>
                            </div> --}}
                        </div>
                        
                        @if(count($select_members) > 0)
                            <form role="form" action="{{action('TeamMemberController@update',[$user->id])}}" method="POST" id="memeberForm">
                        @else
                        <form role="form" action="{{action('TeamMemberController@store')}}" method="POST" id="memeberForm">
                        @endif
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="employee_table">
                                                    <tr>
                                                        <td style='width:160px;'>
                                                            <b>Group 1:</b><br/>
                                                            <select multiple="multiple" id='lstBox1' style="width: 100%;" name="team1[]">
                                                            @foreach ($members as $member)
                                                                <option value="{{$member->id}}">{{$member->name}}</option>
                                                            @endforeach
                                                            </select>
                                                        </td>
                                                        <td style='width:50px;text-align:center;vertical-align:middle;'>
                                                            <input type='button' id='btnRight' value ='  >  '/>
                                                            <br/><input type='button' id='btnLeft' value ='  <  '/>
                                                        </td>
                                                        <td style='width:160px;'>
                                                            <b>Group 2: </b><br/>
                                                            @if(@$select_members)
                                                                <select multiple="multiple" id='lstBox2' style="width: 100%;" name="team2[]">
                                                                    @foreach ($select_members as $member)
                                                                        <option value="{{$member->users->id}}">{{$member->users->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <select multiple="multiple" id='lstBox1' style="width: 100%;" name="team2[]">
                                                                
                                                                </select>
                                                            @endif
                                                            <span class="form-text text-danger"
                                                                id="error_team2">{{ $errors->getBag('default')->first('team2') }}</span>
                                                        </td>
                                                    </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                </div><!--row-->
                            </div><!--card-body-->
                            <div class="card-footer">
                                <div class="col text-right">
                                        @if(count($select_members) > 0)
                                            <button type="submit" class="btn btn-primary" > Update</button>
                                        @else
                                            <button type="submit" class="btn btn-primary" > Submit</button>
                                        @endif

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
@section('customJsInclude')

<script>
        $(function () {

            $('#btnRight').click(function(e) {
                var selectedOpts = $('#lstBox1 option:selected');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }

                $('#lstBox2').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });
            $('#btnLeft').click(function(e) {
                var selectedOpts = $('#lstBox2 option:selected');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }

                $('#lstBox1').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });

         
        })
           $('#memeberForm').submit(function(){
               $('#lstBox2 option').attr('selected',true);
               $('#lstBox1 option').attr('selected',true);

            });
</script>

@endsection
