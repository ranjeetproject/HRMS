<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DepartmentRepository;


class DepartmentController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->departmentRepository->getAll($input);
        } else {
            return view('department.index');

        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
        ]);
        $input = $request->all();
        $data = $this->departmentRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Department name is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('DepartmentController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $department = $this->departmentRepository->viewEdit($id);
        return view('department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required',
        ]);
        $input = $request->all();
        $data = $this->departmentRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Department name is successfully Update!',
                'alert-type' => 'success'
            );
            return redirect()->action('DepartmentController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $this->departmentRepository->deleteSpecific($id);
        $notification = array(
            'message' => 'Department name Deleted successfully',
            'alert-type' => 'error'
        );
        return redirect()->action('DepartmentController@index')
            ->with($notification);
    }

}
