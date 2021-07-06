<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SalarySetUpRepository;

class SalarySetUpController extends Controller
{
    protected $salarySetUpRepository;

    public function __construct(SalarySetUpRepository $salarySetUpRepository)
    {
        $this->salarySetUpRepository = $salarySetUpRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
             return $this->salarySetUpRepository->getAll($input);
        } else {
             return view('salary_set.index');
        }
    }
    public function create($id)
    {
        $data['salary_set_up'] = $this->salarySetUpRepository->getCurrentEmployee($id);
        $data['salary_set_up_detils'] = $this->salarySetUpRepository->getCurrentEmployeeSalaryDetails($id);
        return view('salary_set.create',$data);
        
    }
    public function fetchGrossSalary(Request $request)
    {
        if ($request->has('gross_salary')) {
            $data['ctc'] = $request->get('gross_salary');
            $data['basic'] = .66 * $data['ctc'];
            $data['hra'] = $data['basic']/2;
            $data['other_allowance'] = $data['ctc']-$data['basic']-$data['hra'];
            return ['success' => true, 'salary' =>  $data];
        } 
    }

    public function store(Request $request)
    {
        $request->validate([
            'salary_type' => 'required',
            'gross_salary'=>'required|numeric',
            'ctc'=>'required|numeric',
            'basic' => 'required|numeric',
            'hra' => 'required|numeric',
            'other_allowances' => 'required|numeric',
            'epf' => 'required|numeric',
            'esi' => 'required|numeric',
            'p_tax' => 'required|numeric',
            'tds' => 'required|numeric',
        ]);
        
        if($request->recruitment_id != null){
            $input = $request->only('recruitment_id','employee_details_id','employee_code','email_id','salary_type','gross_salary','ctc','basic','hra','other_allowances','epf','esi','p_tax','tds');
        }else{
            $input = $request->only('employee_details_id','name_of_candidate','employee_code','email_id','salary_type','gross_salary','ctc','basic','hra','other_allowances','epf','esi','p_tax','tds');
        }
        $user = $this->getUser();
        $data = $this->salarySetUpRepository->insert($input,$user);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Salary Set Up is successfully added!',
                    'alert-type' => 'success'
               );
               return redirect()->action('SalarySetUpController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }

    public function show($id)
    {
        $salary_set_up = $this->salarySetUpRepository->view($id);
        return view('salary_set.show',compact('salary_set_up'));
    }

    public function edit($id)
    {
        $salary_set_up_edit = $this->salarySetUpRepository->viewEdit($id);
        return view('salary_set.edit', compact('salary_set_up_edit'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'salary_type' => 'required',
            'gross_salary'=>'required|numeric',
            'ctc'=>'required|numeric',
            'basic' => 'required|numeric',
            'hra' => 'required|numeric',
            'other_allowances' => 'required|numeric',
            'epf' => 'required|numeric',
            'esi' => 'required|numeric',
            'p_tax' => 'required|numeric',
            'tds' => 'required|numeric',
        ]);

        $input = $request->only('recruitment_id','employee_details_id','employee_code','email_id','salary_type','gross_salary','ctc','basic','hra','other_allowances','epf','esi','p_tax','tds');
        $data = $this->salarySetUpRepository->updateSave($input,$id);
          if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Salary Set Up is successfully update!',
                    'alert-type' => 'success'
               );
               return redirect()->action('SalarySetUpController@index')->with($notification);
          } else {
               return redirect()->back();
          }
    }

    public function destroy($id)
     {
          $user = $this->getUser();
          $this->salarySetUpRepository->deleteSpecific($id,$user);
          $notification = array(
             'message' => 'Salary Set Up Deleted successfully',
             'alert-type' => 'success'
           );
          return redirect()->action('SalarySetUpController@index')
             ->with($notification);
     }

    
}
