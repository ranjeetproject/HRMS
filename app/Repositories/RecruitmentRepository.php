<?php


namespace App\Repositories;

use App\Recruitment;
use App\InterviewSchedule;
use App\InterviewFeedback;
use App\Skill;
use App\User;
use App\UserPermission;
use App\CandidateSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;


class RecruitmentRepository
{

    public function getAll()
    {
        $data = Recruitment::orderBy('recruitments.created_at', 'DESC')
        ->leftJoin('interview_feedback','interview_feedback.recruitment_id','=','recruitments.id')
        ->where('recruitments.status','!=', 1)
        ->where('recruitments.status','!=', 2)
        ->get([
            'recruitments.id', 'recruitments.name_of_candidate','recruitments.mobile_number','recruitments.total_years_experience','recruitments.total_months_experience','recruitments.address','recruitments.email_id','recruitments.upload_resume',
            DB::raw('CASE WHEN interview_status = 0 THEN "Pending"
            WHEN interview_status = 1 THEN "Interview Scheduled" WHEN interview_status = 2 THEN "Done" END AS interview_status'),
            DB::raw('CASE WHEN active = 0 THEN ""
            WHEN active = 1 THEN "Selected for Final Round" WHEN active = 2 THEN "Rejected" WHEN active = 3 THEN "On Hold" END AS active')
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="'.action('RecruitmentController@show', $row->id) .'" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>
                <a href="'.action('RecruitmentController@edit', $row->id) .'" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="' . action('RecruitmentController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
                onsubmit="return confirm(\'Are you sure want to delete this row?\');"><input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
                        </form> 
                <a href="'.action('RecruitmentController@interviewScheduling', $row->id) .'" data-toggle="tooltip" data-placement="top" title="Interview Scheduling" class="btn btn-dark">
                <i class="fa fa-wheelchair"></i> 
                </a>
                <a href="'.action('RecruitmentController@interviewFeedback', $row->id) .'" data-toggle="tooltip" data-placement="top" title="Interview Feedback" class="btn btn-secondary">
                <i class="fas fa-comment-dots"></i>
                </a>';
                if(isset($row['upload_resume']))
                {
                    $html .= '<a href="'.action('RecruitmentController@downloadfile', $row->upload_resume) .'" data-toggle="tooltip" data-placement="top" title="Download Document" class="btn btn-success">
                                <i class="fas fa-file-download"></i>
                            </a>';
                }

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }


    public function fetchSkills()
    {
        return Skill::get([
            'id', 'skill_name'
        ]);
    }

    public function fetchRecruitmentSkills($id)
    {
        $all=CandidateSkill::select('skill_id')
        ->where('recruitment_id',$id)
       ->get()->toArray();
       return $all;
    }

    public function insert($inputData,$user)
    {
        
        $recruitmentData = [];
        $recruitmentData['name_of_candidate'] = $inputData['name_of_candidate'];
        $recruitmentData['mobile_number'] = $inputData['mobile_number'];
        $recruitmentData['alternate_number'] = $inputData['alternate_number'];
        $recruitmentData['total_years_experience'] = $inputData['total_years_experience'];
        $recruitmentData['total_months_experience'] = $inputData['total_months_experience'];
        $recruitmentData['address'] = $inputData['address'];
        $recruitmentData['relevent_years_experience'] = $inputData['relevent_years_experience'];
        $recruitmentData['relevent_months_experience'] = $inputData['relevent_months_experience'];
        $recruitmentData['email_id'] = $inputData['email_id'];
        $recruitmentData['application_for'] = $inputData['application_for'];
        $recruitmentData['highest_qualification'] = $inputData['highest_qualification'];
        $recruitmentData['current_ctc'] = $inputData['current_ctc'];
        $recruitmentData['expected_ctc'] = $inputData['expected_ctc'];
        $recruitmentData['current_location'] = $inputData['current_location'];
        $recruitmentData['notice_period'] = $inputData['notice_period'];
        $recruitmentData['refferdby'] = $inputData['refferdby'];
        $recruitmentData['special_remarks'] = $inputData['special_remarks'];
        $recruitmentData['upload_resume'] = $inputData['upload_resume'];
        $row = Recruitment::create($recruitmentData);
        if ($row && $row->id > 0) {
           foreach($inputData['skill'] as $val){
            $recruitmentSkillData = [];
            $recruitmentSkillData['skill_id'] = $val;
            $recruitmentSkillData['recruitment_id'] = $row->id;
            CandidateSkill::create($recruitmentSkillData);
           }
        $this->sendNotificationForRecruitment($row->id,$user);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function view($id)
    {
        $row = Recruitment::find($id);
        return $row;
    }

    public function viewEdit($id)
    {
        $row = Recruitment::find($id);
        return $row;
    }

    public function updateSave($inputData, $id)
    {

        $row = Recruitment::find($id);
        if($row){
            if(!array_key_exists("upload_resume",$inputData)){
                $inputData['upload_resume'] = $row->upload_resume;
            }
            $row->name_of_candidate = $inputData['name_of_candidate'];
            $row->mobile_number = $inputData['mobile_number'];
            $row->alternate_number = $inputData['alternate_number'];
            $row->address = $inputData['address'];
            $row->total_years_experience = $inputData['total_years_experience'];
            $row->total_months_experience = $inputData['total_months_experience'];
            $row->relevent_years_experience = $inputData['relevent_years_experience'];
            $row->relevent_months_experience = $inputData['relevent_months_experience'];
            $row->email_id = $inputData['email_id'];
            $row->highest_qualification = $inputData['highest_qualification'];
            $row->current_ctc = $inputData['current_ctc'];
            $row->expected_ctc = $inputData['expected_ctc'];
            $row->current_location = $inputData['current_location'];
            $row->notice_period = $inputData['notice_period'];
            $row->refferdby = $inputData['refferdby'];
            $row->special_remarks = $inputData['special_remarks'];
            $row->upload_resume = $inputData['upload_resume'];
            $row->save();
            $skill = CandidateSkill::where('recruitment_id','=',$id)->pluck('skill_id','id')->toArray();
            if($skill){
                foreach($inputData['skill']  as $val){
                    if(!in_array($val,$skill))
                    {
                        CandidateSkill::create([
                                'skill_id'=>$val,
                                'recruitment_id'=> $id
                                ]);
                    }
                        
                }
                $oldSkill = array_diff($skill,$inputData['skill']);
                if(count($oldSkill) > 0)
                {
                    CandidateSkill::where('recruitment_id','=',$id)->whereIn('skill_id',$oldSkill)->delete();
                }
            }
            
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id,$user)
    {

        if ($id > 0) {
            $row = Recruitment::find($id);
     
            if ($row) {
                InterviewSchedule::where('recruitment_id',$row->id)->delete();
                InterviewFeedback::where('recruitment_id',$row->id)->delete();
                $this->sendNotificationForRecruitment($row->id,$user);
                $row->delete();
                
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }

    public function viewSchedule($id)
    {
        $schedule = InterviewSchedule::where('recruitment_id',$id)->first();
        $schedule['interview_scheduling_date'] = date('d-m-Y',strtotime($schedule['interview_scheduling_date']));
        return $schedule;

    }
    public function viewFeedback($id)
    {
        $feedback = InterviewFeedback::where('recruitment_id',$id)->first();
        $feedback['interview_scheduling_date'] = date('d-m-Y',strtotime($feedback['interview_scheduling_date']));
        return $feedback;

    }
    public function sendNotificationForRecruitment($recruitmentId,$user)
    {
        $currentUrl= URL::current();
        $explode_url = explode('/', $currentUrl);
        $url = end($explode_url);
        if($url == 'store'){
            $recruitmentId = Recruitment::find($recruitmentId);
            if ($recruitmentId) {
                $notificationRepo = new NotificationRepository();
                $notificationData = [];
                $notificationData['view_url'] = action('RecruitmentController@store', ['id' => $recruitmentId->id]);
                $notificationData['recruitment_id'] = $recruitmentId->id;
                if ($user) {
                    $name = $user->name;
                    $notificationData['user_id'] = $user->id;
                }
                $notificationData['text'] = $name . ' Create Recruitment.';
                $notificationRepo->insert($notificationData);
            }
       
        }else{
            $recruitmentId = Recruitment::find($recruitmentId);
            if ($recruitmentId) {
                $notificationRepo = new NotificationRepository();
                $notificationData = [];
                $notificationData['view_url'] = action('RecruitmentController@destroy', ['id' => $recruitmentId->id]);
                $notificationData['recruitment_id'] = $recruitmentId->id;
                if ($user) {
                    $name = $user->name;
                    $notificationData['user_id'] = $user->id;
                }
                $notificationData['text'] = $name . ' Delete Recruitment.';
                $notificationRepo->insert($notificationData);
            }
        }
 
    }

    public function fetchUsersInterviewer()
    {
        $row = User::get();
        return $row;
    }

    public function checkPermission($user)
    {
        $row = UserPermission::Where('department_id','=',$user->department_id)->Where('designation_id','=',$user->designation_id)->get();
        return $row;
    }

}