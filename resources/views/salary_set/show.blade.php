@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Salary Set Up Management</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{action('HomeController@index')}}"> <i class="fas fa-home"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href=""> <i class="fas fa-money-bill-alt"></i>
                                    Salary Set Up</a></li>
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
                                <a class="btn btn-danger" href="{{action('SalarySetUpController@index')}}" style="float:right">
                                            Back </a>

                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <tr>
                                    @if(@$salary_set_up->recruitment->name_of_candidate)
                                        <th>Name of Candidate</th>
                                        <td>{{@$salary_set_up->recruitment->name_of_candidate}}</td>
                                    @else
                                        <th>Name Of Candidate</th>
                                        <td>{{@$salary_set_up->name_of_candidate}}</td>
                                    @endif
                                    </tr>
                                    <tr>
                                        <th>Employee Code</th>
                                        <td>{{@$salary_set_up->employee_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email id</th>
                                        <td>{{@$salary_set_up->email_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Salary Type</th>
                                        <td>{{@$salary_set_up->salary_type}}</td>
                                    </tr>
                                    <tr>
                                        <th>Gross Salary</th>
                                        <td>{{@$salary_set_up->gross_salary}}</td>
                                    </tr>
                                     <tr>
                                        <th>CTC</th>
                                        <td>{{@$salary_set_up->ctc}}</td>
                                    </tr>
                                    <tr>
                                        <th>Basic</th>
                                        <td>{{@$salary_set_up->basic}}</td>
                                    </tr>
                                    <tr>
                                        <th>HRA</th>
                                        <td>{{@$salary_set_up->hra}}</td>
                                    </tr>
                                     <tr>
                                        <th>Other Allowances</th>
                                        <td>{{@$salary_set_up->other_allowances}}</td>
                                    </tr>
                                     <tr>
                                        <th>EPF</th>
                                        <td>{{@$salary_set_up->epf}}</td>
                                    </tr>
                                    <tr>
                                        <th>ESI</th>
                                        <td>{{@$salary_set_up->esi}}</td>
                                    </tr>
                                    <tr>
                                        <th>P TAX</th>
                                        <td>{{@$salary_set_up->p_tax}}</td>
                                    </tr>
                                     <tr>
                                        <th>TDS</th>
                                        <td>{{@$salary_set_up->tds}}</td>
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