<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeesLeaveRepository;


class EmployeesLeaveController extends Controller
{
    protected $departmentRepository;

    public function __construct(EmployeesLeaveRepository $employeesLeaveRepository)
    {
        $this->employeesLeaveRepository = $employeesLeaveRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->employeesLeaveRepository->getAll($input);
        } else {
            return view('employees_leaves.index');

        }
    }

    public function getAllEmployeesLeaves(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->employeesLeaveRepository->getAllLeavesDetails($input);
        } else {
            return view('employees_leaves.all-employees-leave-details');

        }
    }

}
