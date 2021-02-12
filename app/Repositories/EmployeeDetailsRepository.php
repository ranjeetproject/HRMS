<?php


namespace App\Repositories;

use App\Recruitment;
use App\User;
use App\InterviewSchedule;
use App\EmployeeDetails;
use App\InterviewFeedback;
use App\Skill;
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
        ->get(['employee_details.id','recruitments.name_of_candidate','email','contact_number','department','designation',]);
    
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('EmployeeDetailsController@employeeDetails',$row->id).'" data-toggle="tooltip" data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i>
                </a>
                <a href="'.action('EmployeeDetailsController@editEmployeeDetails',$row->id).'" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
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

    public function insert($inputData){
        $inputData['date_of_birth'] = date('Y-m-d',strtotime($inputData['date_of_birth']));
        $inputData['date_of_joining'] = date('Y-m-d',strtotime($inputData['date_of_joining']));
        $row = EmployeeDetails::create($inputData);
        if ($row && $row->id > 0) {
            $userData = [];
            $password = $inputData['name_of_candidate'].'@123';
            $userData['password'] = Hash::make($password);
            $userData['user_type'] = 1;
            $userData['active'] = 1;
            $userData['remember_token'] = Str::random(32);
            $userData['name'] = $inputData['name_of_candidate'];
            $userData['email'] = $inputData['offical_email_id'];
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
        $row = EmployeeDetails::find($id);
        if ($row) {
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}