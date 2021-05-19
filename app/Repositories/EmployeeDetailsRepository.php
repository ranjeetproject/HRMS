<?php


namespace App\Repositories;

use App\Recruitment;
use App\User;
use App\InterviewSchedule;
use App\EmployeeDetails;
use App\InterviewFeedback;
use App\Skill;
use App\Department;
use App\Designation;
use App\CandidateSkill;
use App\FinalRoundInterviewScheduling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Mail;



class EmployeeDetailsRepository
{

    public function getAll()
    {
        $data = EmployeeDetails::orderBy('employee_details.created_at', 'DESC')
        ->leftJoin('recruitments','recruitments.id','=','employee_details.recruitment_id')
        ->leftJoin('departments','departments.id','=','employee_details.department_id')
        ->leftJoin('designations','designations.id','=','employee_details.designation_id')
        ->where('employee_details.status_serving','!=',3)
        ->get(['employee_details.id','recruitments.name_of_candidate','email','contact_number','designations.designation_name','departments.department_name',	
        DB::raw('CASE WHEN status_probation = 0 THEN ""
        WHEN status_probation = 1 THEN "On Probation" WHEN status_probation = 2 THEN "Confirmed" END AS status_probation'),
        DB::raw('CASE WHEN status_serving = 0 THEN ""
        WHEN status_serving = 1 THEN "Serving" WHEN status_serving = 2 THEN "On Notice" END AS status_serving')]);
    
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('EmployeeDetailsController@employeeDetails',$row->id).'" data-toggle="tooltip" data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i>
                </a>
                <a href="'.action('EmployeeDetailsController@editEmployeeDetails',$row->id).'" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>
                <a href="'.action('SalarySetUpController@create',$row->id).'" data-toggle="tooltip" data-placement="top" title="Salary Set Up" class="btn btn-warning">
                <i class="fas fa-money-bill-alt"></i>
                </a>';
                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function fetchCandidateDetails($id)
    {
        $recruitmentCandidateDetails = InterviewFeedback::find($id);
        return $recruitmentCandidateDetails;
    }
    public function fetchSkills()
    {
        return Skill::get([
            'id', 'skill_name'
        ]);
    }
    public function fetchDepartments()
    {
        return Department::get([
            'id', 'department_name'
        ]);
    }
    public function fetchDesignations()
    {
        return Designation::get([
            'id', 'designation_name'
        ]);
    }
    public function fetchRecruitmentSkills($id)
    {
        $recruitmentId=InterviewFeedback::find($id);
        $recruitmentSkill = CandidateSkill::select('skill_id')
        ->where('recruitment_id', $recruitmentId->recruitment_id)
       ->get()->toArray();
       return $recruitmentSkill;
        
    }
    public function fetchEmployeeSkills($id)
    {
        $recruitmentId=EmployeeDetails::find($id);
        $recruitmentSkill = CandidateSkill::select('skill_id')
        ->where('recruitment_id', $recruitmentId->recruitment_id)
       ->get()->toArray();
       return $recruitmentSkill;
        
    }

    public function insert($inputData,$user){
        $inputData['date_of_birth'] = date('Y-m-d',strtotime($inputData['date_of_birth']));
        $inputData['date_of_joining'] = date('Y-m-d',strtotime($inputData['date_of_joining']));
        $inputData['date_of_released'] = date('Y-m-d',strtotime($inputData['date_of_released']));
        $inputData['date_of_confirmed'] = date('Y-m-d',strtotime($inputData['date_of_confirmed']));

        $row = EmployeeDetails::create($inputData);
        if ($row && $row->id > 0) {
            $this->sendNotificationForFeedBack($row->id,$user);
            $skill = CandidateSkill::where('recruitment_id','=',$inputData['recruitment_id'])->pluck('skill_id','id')->toArray();
            if($skill){
                foreach($inputData['skill']  as $val){
                    if(!in_array($val,$skill))
                    {
                        CandidateSkill::create([
                                'skill_id'=>$val,
                                'recruitment_id'=> $inputData['recruitment_id'],
                                ]);
                    }
                        
                }
                $oldSkill = array_diff($skill,$inputData['skill']);
                if(count($oldSkill) > 0)
                {
                    CandidateSkill::where('recruitment_id','=',$inputData['recruitment_id'])->whereIn('skill_id',$oldSkill)->delete();
                }
            }
            $userData = [];
            $password = $inputData['name_of_candidate'].'@123';
            $userData['password'] = Hash::make($password);
            $userData['department_id'] = $inputData['department_id'];
            $userData['designation_id'] = $inputData['designation_id'];
            $userData['active'] = 1;
            $userData['remember_token'] = Str::random(32);
            $userData['name'] = $inputData['name_of_candidate'];
            $userData['email'] = $inputData['offical_email_id'];
            $userData['recruitment_id'] = $inputData['recruitment_id'];
            $userData['employee_details_id'] = $row->id;
            $user = User::create($userData);
            Mail::send('emails.registration', ['row' => $user, 'password' => $password], function ($m) use ($user) {
                $m->from(Config::get('app.email_send'));
                $m->to($user->email, $user->name)->subject('Welcome to Brainium Infotech');
            });
            return ['success' => true];
        } else {
            return ['success' => false];
        }
        
    }
    
    public function fetchUserDetails($id){
        $row = EmployeeDetails::where('feedback_id','=',$id)->first();
        return $row;
    }


    public function view($id)
    {
        $row = EmployeeDetails::find($id);
        return $row;
    }

    public function viewEdit($id)
    {
        $row = EmployeeDetails::find($id);
        return $row;
    }

    public function updateSave($inputData, $id)
    {
        $inputData['date_of_birth'] = date('Y-m-d',strtotime($inputData['date_of_birth']));
        $inputData['date_of_joining'] = date('Y-m-d',strtotime($inputData['date_of_joining']));
        $inputData['date_of_released'] = date('Y-m-d',strtotime($inputData['date_of_released']));
        $inputData['date_of_confirmed'] = date('Y-m-d',strtotime($inputData['date_of_confirmed']));
        $row = EmployeeDetails::find($id);
        if ($row) {
            $skill = CandidateSkill::where('recruitment_id','=',$inputData['recruitment_id'])->pluck('skill_id','id')->toArray();
            if($skill){
                foreach($inputData['skill']  as $val){
                    if(!in_array($val,$skill))
                    {
                        CandidateSkill::create([
                                'skill_id'=>$val,
                                'recruitment_id'=> $inputData['recruitment_id'],
                                ]);
                    }
                        
                }
                $oldSkill = array_diff($skill,$inputData['skill']);
                if(count($oldSkill) > 0)
                {
                    CandidateSkill::where('recruitment_id','=',$inputData['recruitment_id'])->whereIn('skill_id',$oldSkill)->delete();
                }
            }
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function sendNotificationForFeedBack($employeeId,$user)
    {
        
            $employeeDetailsId = EmployeeDetails::find($employeeId);
            if ($employeeDetailsId) {
                $notificationRepo = new NotificationRepository();
                $notificationData = [];
                $notificationData['view_url'] = action('EmployeeDetailsController@storeOfferEmployee', ['id' => $employeeDetailsId->id]);
                $notificationData['interview_feedback_id'] = $employeeDetailsId->id;
                if ($user) {
                    $name = $user->name;
                    $notificationData['user_id'] = $user->id;
                }
                $notificationData['text'] = $name . ' Employee Details.';
                $notificationRepo->insert($notificationData);
            }
 
    }
}