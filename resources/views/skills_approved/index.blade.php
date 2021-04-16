@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Skills Approved</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""><i class="nav-icon fas fa-thumbs-up"></i>
                                    Skills Approved</a></li>
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
                                <h3 class="card-title"><i class="fas fa-align-justify"></i>  Skills Approved</h3>
                                {{-- <a class="btn btn-danger" href="{{action('RecruitmentController@index')}}" style="float:right">
                                            Back </a> --}}
                            </div>
                            <span id="success-message" style="color:#ed0f12;padding:10px;margin-left:90%;"></span>
                                    <div class="card-body">
                                    {{-- {{dd($aquired_skills)}} --}}
                                    @foreach ($aquired_skills as $aquired_skills_val)
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label class="form-control-label" for="name_of_candidate">Team Mates Name</label>
                                                    <input
                                                        class="form-control {{ $errors->has('name_of_candidate') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="name_of_candidate" id="name_of_candidate" placeholder="Please enter name of candidate"
                                                        maxlength="191"
                                                        value="{{old('name_of_candidate',$aquired_skills_val->name)}}">
                                                    <span class="form-text text-danger"
                                                        id="error_name_of_candidate">{{ $errors->getBag('default')->first('name_of_candidate') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="skill_name">Skill Name</label>
                                                    <input
                                                        class="form-control {{ $errors->has('skill_name') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="skill_name" id="skill_name" placeholder="Please enter skill name"
                                                        maxlength="191"
                                                        value="{{old('skill_name',$aquired_skills_val->skill_name)}}">
                                                    <span class="form-text text-danger"
                                                        id="error_skill_name">{{ $errors->getBag('default')->first('skill_name') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="aquired_date">Aquire Date</label>
                                                    <input
                                                        class="form-control {{ $errors->has('aquired_date') ? 'is-invalid' : '' }}"
                                                        type="text"
                                                        name="aquired_date" id="aquired_date" placeholder="Please enter aquired date"
                                                        maxlength="191"
                                                        value="{{old('aquired_date',$aquired_skills_val->acquire_date)}}">

                                                    <span class="form-text text-danger"
                                                        id="error_aquired_date">{{ $errors->getBag('default')->first('aquired_date') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class=" form-control-label" for="status">Status</label>
                                                    <select
                                                            class="form-control custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                                            name="status" id="status" onchange="changeStatus(this.value,{{$aquired_skills_val->id}})">
                                                            <option value="">Select</option>
                                                            <option value="2">Disapproved</option>
                                                            <option value="1">Approved</option>
                                                        </select>

                                                    <span class="form-text text-danger"
                                                        id="error_status">{{ $errors->getBag('default')->first('status') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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

     function changeStatus(id,status_val){
          
           var id = id;
           var status_val = status_val;
           var dataValue = {
                        id: id,
                        status_val:status_val
                    }

            var baseUrl = '{{action("SkillsApprovedController@approveAndDisapprove")}}';
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
                                }, 2000);
                           }else{
                               $("#success-message").html(data.message);
                               setTimeout(function () {
                                    $("#success-message").html('');
                                }, 2000);
                           }
                        }
                    });

         
      }
  $(function () {   
      
     
      $("#aquired_date").datepicker();
  })
    </script>
@endsection