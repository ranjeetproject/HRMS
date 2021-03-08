<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReleasedEmployeesRepository;


class ReleasedEmployeesController extends Controller
{
    protected $releasedEmployeesRepository;

    public function __construct(ReleasedEmployeesRepository $releasedEmployeesRepository)
    {
        $this->releasedEmployeesRepository = $releasedEmployeesRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->releasedEmployeesRepository->getAll($input);
        } else {
            return view('released_employees.index');
        }
        
    }

    public function show($id)
    {
        $data['employee_details'] = $this->releasedEmployeesRepository->view($id);
        return view('released_employees.show',$data);
    }
    
}
