<?php


namespace App\Repositories;

use App\Designation;
use App\Department;
use App\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class UserPermissionnRepository
{

    public function getAll($input)
    {
        $data = UserPermission::orderBy('user_permissions.created_at', 'DESC')
        ->leftJoin('departments','departments.id','=','user_permissions.department_id')
        ->leftJoin('designations','designations.id','=','user_permissions.designation_id')
        ->get([
            'user_permissions.id', 'designations.designation_name','departments.department_name'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = ' <a href="' . action('UserPermissionController@edit', $row->id) . '" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function fetchDepartment()
    {
       $row = Department::get([
            'id', 'department_name'
        ]);
        return $row;
    }

    public function fetchDesignation()
    {
       $row = Designation::get([
            'id', 'designation_name'
        ]);
        return $row;
    }

    public function insert($inputData)
    {
        $row = UserPermission::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function viewEdit($id)
    {
        $row = UserPermission::find($id);
        return $row;
    }

    public function updateSave($inputData, $id)
    {
        $row = UserPermission::find($id);
        if ($row) {
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    
}