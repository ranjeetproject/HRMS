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
        $data['departments'] =  $this->employeeDetailRoundRepository->fetchDepartments();
        $data['designations'] =  $this->employeeDetailRoundRepository->fetchDesignations();
        $data['recruitmentSkills'] =  $this->employeeDetailRoundRepository->fetchRecruitmentSkills($id);
        $data['reportingHeads'] =  $this->employeeDetailRoundRepository->fetchReportingHeadDetails();
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
            'offical_email_id'=>'required|email',
            'contact_number' => 'required',
            'date_of_joining' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
        $input = $request->all();
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
        //$existingSkillData = array();
        $data['employee_details'] = $this->employeeDetailRoundRepository->viewEdit($id);
        $data['skills'] =  $this->employeeDetailRoundRepository->fetchSkills();
        $data['departments'] =  $this->employeeDetailRoundRepository->fetchDepartments();
        $data['designations'] =  $this->employeeDetailRoundRepository->fetchDesignations();
        $data['recruitmentSkills'] =  $this->employeeDetailRoundRepository->fetchEmployeeSkills($id);
        $data['employeeSkills'] =  $this->employeeDetailRoundRepository->fetchExistingEmployeeSkills($id);
        $data['reportingHeads'] =  $this->employeeDetailRoundRepository->fetchReportingHeadDetails();
        foreach($data['recruitmentSkills'] as $key => $val)
        {
           $skilldata[] = $val['skill_id'];
        }
        foreach($data['employeeSkills'] as $key => $val)
        {
           $skilldata[] = $val['skill_id'];
        }
          return view('employee_details.edit',$data,compact('skilldata'));
    }

    public function updateEmployeeDetails(Request $request, $id)
    {
        $request->validate([
            'name_of_candidate' => 'required',
            'reporting_head'=>'required',
            'email'=>'required|email',
            'offical_email_id'=>'required|email',
            'date_of_joining' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
        if($request->recruitment_id != null){
            $input = $request->only('reporting_head','recruitment_id','email','offical_email_id','emp_code','contact_number','alternate_number',
                                'permanent_address','current_address','father_name','mother_name','date_of_birth','date_of_joining',
                                'marital_status','name_of_spouse','total_years_experience','total_months_experience','highest_qualification','department_id','designation_id','skill','status_probation','status_serving','date_of_released','date_of_confirmed');
        }else{
            $input = $request->only('reporting_head','name_of_candidate','recruitment_id','email','offical_email_id','emp_code','contact_number','alternate_number',
                                'permanent_address','current_address','father_name','mother_name','date_of_birth','date_of_joining',
                                'marital_status','name_of_spouse','total_years_experience','total_months_experience','highest_qualification','department_id','designation_id','skill','status_probation','status_serving','date_of_released','date_of_confirmed');
        }
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
