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
        $skilldata = array();
        $data['candiateDetails'] = $this->employeeDetailRoundRepository->fetchCandidateDetails($id);
        $data['userDetails'] = $this->employeeDetailRoundRepository->fetchUserDetails($id);
        $data['skills'] =  $this->employeeDetailRoundRepository->fetchSkills();
        $data['recruitmentSkills'] =  $this->employeeDetailRoundRepository->fetchRecruitmentSkills($id);
        foreach($data['recruitmentSkills'] as $key => $val)
        {
           $skilldata[] = $val['skill_id'];
        }
        return view('employee_details.create',$data,compact('skilldata'));
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
        $input = $request->only('name_of_candidate','recruitment_id','feedback_id','reporting_head','email','emp_code','contact_number','alternate_number',
                                'permanent_address','current_address','offical_email_id','father_name','mother_name','date_of_birth','date_of_joining',
                                'marital_status','name_of_spouse','total_years_experience','total_months_experience','highest_qualification','department','designation','skill');
        $user = $this->getUser();
        $data = $this->employeeDetailRoundRepository->insert($input,$user);
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

    public function editEmployeeDetails($id)
    {
        $skilldata = array();
        $data['employee_details'] = $this->employeeDetailRoundRepository->viewEdit($id);
        $data['skills'] =  $this->employeeDetailRoundRepository->fetchSkills();
        $data['recruitmentSkills'] =  $this->employeeDetailRoundRepository->fetchEmployeeSkills($id);
        foreach($data['recruitmentSkills'] as $key => $val)
        {
           $skilldata[] = $val['skill_id'];
        }
          return view('employee_details.edit',$data,compact('skilldata'));
    }

    public function updateEmployeeDetails(Request $request, $id)
    {
        $input = $request->only('reporting_head','recruitment_id','email','offical_email_id','emp_code','contact_number','alternate_number',
                                'permanent_address','current_address','father_name','mother_name','date_of_birth','date_of_joining',
                                'marital_status','name_of_spouse','total_years_experience','total_months_experience','highest_qualification','department','designation','skill');
        $data = $this->employeeDetailRoundRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                    'message' => 'User Details is successfully update!',
                    'alert-type' => 'success'
            );
            return redirect()->action('EmployeeDetailsController@currentEmployeeList')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    

}
