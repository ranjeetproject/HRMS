<?php


namespace App\Repositories;

use App\User;
use App\Employee;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class EmployeeRepository
{

    public function getAll()
    {
        $data = User::orderBy('created_at', 'ASC')->get([
            'id', 'name','email'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }
    public function fetchCategories()
    {
        return Category::get([
            'id', 'cname'
        ]);
    }

    public function insert($inputData)
    {
        
        $userData = [];
        $userData['name'] = $inputData['name'];
        $userData['email'] = $inputData['email'];
        $password = 'demo1234';
        $userData['password'] = Hash::make($password);
        $userData['user_type'] = $inputData['category'];
        $userData['active'] = 0;
        $userData['remember_token'] = Str::random(32);
        
        $user = User::create($userData);
        if($user){
            $memberData = [];
            $memberData['user_id'] = $user->id;
            $memberData['name'] = $inputData['name'];
            $memberData['email'] = $inputData['email'];
            $memberData['contact_no'] = $inputData['contact_no'];
            $memberData['address'] = $inputData['address'];
            $memberData['join_date']=date('Y-m-d',strtotime($inputData['join_date']));
            $memberData['appraisal_date'] = date('Y-m-d',strtotime($inputData['appraisal_date']));
            $memberData['birth'] = date('Y-m-d',strtotime($inputData['birth']));
            $row = Employee::create($memberData);

            if ($row && $row->id > 0) {
                return ['success' => true];
            }else{
                return ['success' => false];
            }
        }
        
    }
}