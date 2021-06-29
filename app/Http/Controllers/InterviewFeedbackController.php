<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InterviewFeedbackRepository;

class InterviewFeedbackController extends Controller
{
    protected $interviewFeedbackRepository;

    public function __construct(InterviewFeedbackRepository $interviewFeedbackRepository)
    {
        $this->interviewFeedbackRepository = $interviewFeedbackRepository;
    }


    public function store(Request $request)
    {
        $request->validate([
            'interview_scheduling_date' => 'required',
            'interview_scheduling_time' => 'required',
            'interviewer_rating' => 'required|numeric',
            'interviewer_feedback'=>'required',
        ]);
       
        $input = $request->only('recruitment_id','schedule_id','interview_scheduling_date','interview_scheduling_time','user_id','interviewer_rating','interviewer_feedback','active');
        $user = $this->getUser();
        // $key =  array_keys($input);
        // $lastkey = end($key);
        // if($lastkey == 'active'){
           
        //     $input['active'] = 1;

        // }else
        // {
            
        //     $input['active'] = 0;
        // }
        $data = $this->interviewFeedbackRepository->insert($input,$user);
        if ($data['success'] == true && isset($data['active']) && $data['active'] == 1) {
            $notification = array(
                'message' => 'Interview Feedback is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('FinalRoundController@index')->with($notification);
        }else if($data['success'] == true && isset($data['active']) && $data['active'] == 3) {
        
            $notification = array(
                'message' => 'Interview Feedback is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('RecruitmentController@index')->with($notification);
            
        }else if($data['success'] == true && isset($data['active']) && $data['active'] == 2) {
            $notification = array(
                'message' => 'Interview Feedback is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('RejectedController@index')->with($notification);
        }else {
            return redirect()->back();
        }
    }

    public function interviewFeedbackEdit($id)
    {
        $data['feedback']    = $this->interviewFeedbackRepository->editFeedback($id);
        $data['interviewers'] = $this->interviewFeedbackRepository->fetchUsersInterviewer();
        return view('Interview_scheduled.interview_feedback_edit',$data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'interviewer_rating' => 'required|numeric',
            'interviewer_feedback'=>'required',
        ]);
        $input = $request->only('recruitment_id', 'interview_scheduling_date','interview_scheduling_time','user_id','interviewer_rating','interviewer_feedback','active');
        $user = $this->getUser();
        // $key =  array_keys($input);
        // $lastkey = end($key);
        // if($lastkey == 'active'){
           
        //     $input['active'] = 1;

        // }else
        // {
            
        //     $input['active'] = 0;
        // }
        $data = $this->interviewFeedbackRepository->updateSave($input,$id,$user);
           if ($data['success'] == true && isset($data['active']) && $data['active'] == 1) {
               $notification = array(
                    'message' => 'Interview feedback is successfully update!',
                    'alert-type' => 'success'
               );
               return redirect()->action('FinalRoundController@index')->with($notification);
            }else if($data['success'] == true && isset($data['active']) && $data['active'] == 3) {
        
                $notification = array(
                    'message' => 'Interview Feedback is successfully update!',
                    'alert-type' => 'success'
                );
                return redirect()->action('RecruitmentController@index')->with($notification);
                
            }else if($data['success'] == true && isset($data['active']) && $data['active'] == 2) {
                $notification = array(
                    'message' => 'Interview Feedback is successfully update!',
                    'alert-type' => 'success'
                );
                return redirect()->action('RejectedController@index')->with($notification);
            }else
           {
            return redirect()->back();
           }
    }

}

