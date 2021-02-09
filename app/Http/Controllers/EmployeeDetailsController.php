<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeDetailsRepository;


class EmployeeDetailsController extends Controller
{
    protected $employeeDetailRoundRepository;

    public function __construct(EmployeeDetailsRepository $employeeDetailRoundRepository)
    {
        $this->employeeDetailRoundRepository = $employeeDetailRoundRepository;
    }
    
    public function offerEmployeeDetails($id)
    {
        $data['candiateDetails'] = $this->employeeDetailRoundRepository->fetchCandidateDetails($id);
        $data['userDetails'] = $this->employeeDetailRoundRepository->fetchUserDetails($id);
        return view('employee_details.create',$data);
    }

    public function storeOfferEmployee(Request $request){

        $request->validate([
            'name_of_candidate' => 'required',
            'reporting_head'=>'required',
            'email'=>'required',
            'emp_code' => 'required|numeric',
            'contact_number' => 'required',
            'alternate_number' => 'required',
            'permanent_address' => 'required',
            'current_address' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'date_of_birth' => 'required',
            'date_of_joining' => 'required',
            'marital_status' => 'required',
            'name_of_spouse' => 'required',
            'total_years_experience' => 'required',
            'total_months_experience' => 'required',
            'highest_qualification' => 'required',
            'department' => 'required',
            'designation' => 'required',
        ]);
        $input = $request->only('recruitment_id','feedback_id','reporting_head','email','emp_code','contact_number','alternate_number',
                                'permanent_address','current_address','father_name','mother_name','date_of_birth','date_of_joining',
                                'marital_status','name_of_spouse','total_years_experience','total_months_experience','highest_qualification','department','designation');
        $data = $this->employeeDetailRoundRepository->insert($input);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'User Details is successfully added!',
                    'alert-type' => 'success'
               );
               return redirect()->action('EmployeeDetailsController@currentEmployeeList')->with($notification);
           } else {
               return redirect()->back();
           }
    }

    public function currentEmployeeList(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->employeeDetailRoundRepository->getAll($input);
        } else {
            return view('employee_details.index');
        }
    }

    public function employeeDetails($id)
    {
        $data['employee_details'] = $this->employeeDetailRoundRepository->view($id);
          return view('employee_details.show',$data);
    }
}
