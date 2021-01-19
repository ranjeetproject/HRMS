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
            'interviewer_rating' => 'required',
            'interviewer_feedback'=>'required',
        ]);
        $input = $request->only('recruitment_id','schedule_id','interview_scheduling_date','interview_scheduling_time','user_id','interviewer_rating','interviewer_feedback','active');
        $key =  array_keys($input);
        $lastkey = end($key);
        if($lastkey == 'active'){
           
            $input['active'] = 1;

        }else
        {
            
            $input['active'] = 0;
        }
        
        $data = $this->interviewFeedbackRepository->insert($input);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Interview Feedback is successfully added!',
                    'alert-type' => 'success'
               );
               return redirect()->action('RecruitmentController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }

    public function interviewFeedbackEdit($id)
    {
        $data['feedback']    = $this->interviewFeedbackRepository->editFeedback($id);
        return view('Interview_scheduled.interview_feedback_edit',$data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'interviewer_rating' => 'required',
            'interviewer_feedback'=>'required',
        ]);
        $input = $request->only('recruitment_id', 'interview_scheduling_date','interview_scheduling_time','user_id','interviewer_rating','interviewer_feedback','active');
        $key =  array_keys($input);
        $lastkey = end($key);
        if($lastkey == 'active'){
           
            $input['active'] = 1;

        }else
        {
            
            $input['active'] = 0;
        }
        $data = $this->interviewFeedbackRepository->updateSave($input,$id);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Interview feedback is successfully update!',
                    'alert-type' => 'success'
               );
               return redirect()->action('RecruitmentController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }

}

