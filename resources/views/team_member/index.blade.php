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
                        <span id="success-message" style="color:#ed0f12;padding:10px;margin-left:90%;"></span>
                        @if(count($select_members) > 0)
                            <form role="forms"  id="memeberUpdateForm">
                        @else
                        <form role="form" id="memeberForm">
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
                                                                            <option value="{{$member->members}}">{{$member->users->name}}</option>
                                                                    @endforeach    
                                                                </select>
                                                            @else
                                                                <select multiple="multiple" id='lstBox1' style="width: 100%;" name="team2[]" class="lstNew">
                                                                
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
        $('#memeberForm').submit(function (e)
        {
            if($("#lstBox2").val()=='' || $("#lstBox2").val()==undefined){
              $("#error_team2").html('Please select team member');
                $("#lstBox2").focus();
                setTimeout(function () {
                $("#error_team2").html('');
                }, 3000);
                return false;
                
            }
            else{
                $("#error_team2").html('');
            }

                
            var dataValue = $('#lstBox2').val();
            var team = {
                        "_token": "{{ csrf_token() }}",
                        "team": dataValue,
                    }
            e.preventDefault();
            var baseUrl = '{{action("TeamMemberController@store")}}';
            $.ajax({
                type: 'POST',
                url: baseUrl,
                data: team,
                success: function (data)
                {
                    if(data.success == true){
                        $("#success-message").html(data.message);
                            setTimeout(function () {
                                $("#success-message").html('');
                            },5000);
                            location.reload();
                    }                        
                },
            });
        });

        $('#memeberUpdateForm').submit(function (e)
        {
            e.preventDefault(); 
            var selectTeam =  [...document.querySelector("#lstBox2").options].map( opt => opt.value );
            if(selectTeam.length == 0){
                var team = {
                        "_token": "{{ csrf_token() }}",
                        "team": null,
                    }
            }else{
                var team = {
                            "_token": "{{ csrf_token() }}",
                            "team": selectTeam,
                        }
            }
            var baseUrl = "{{action('TeamMemberController@update',[$user->id])}}";
            $.ajax({
            type: 'POST',
                url: baseUrl,
                data: team,
                success: function (data)
                {
                    if(data.success == true){
                        $("#success-message").html(data.message);
                            setTimeout(function () {
                                $("#success-message").html('');
                            },5000);
                            location.reload();
                    }    
                }
            });     
           
   
          
        });
        
</script>

@endsection
