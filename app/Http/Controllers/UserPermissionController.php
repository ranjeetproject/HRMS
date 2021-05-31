<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserPermissionnRepository;


class UserPermissionController extends Controller
{
    protected $userPermissionRepository;

    public function __construct(UserPermissionnRepository $userPermissionRepository)
    {
        $this->userPermissionRepository = $userPermissionRepository;
    }

    public function index(Request $request)
    {
        $data['departments'] =  $this->userPermissionRepository->fetchDepartment();
        $data['designations'] =  $this->userPermissionRepository->fetchDesignation();
        $input = $request->all();
        if ($request->ajax()) {
            return $this->userPermissionRepository->getAll($input);
        } else {
            return view('user-permission.index',$data);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
        $input = $request->all();
        $data = $this->userPermissionRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'User Permission is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('UserPermissionController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data['departments']  =  $this->userPermissionRepository->fetchDepartment();
        $data['designations'] =  $this->userPermissionRepository->fetchDesignation();
        $data['permission']   =  $this->userPermissionRepository->viewEdit($id);
        return view('user-permission.edit',$data);
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();
        $data = $this->userPermissionRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'User Permission is successfully update!',
                'alert-type' => 'success'
            );
            return redirect()->action('UserPermissionController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }



}
