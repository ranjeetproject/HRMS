<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InterviewScheduleRepository;


class InterviewScheduleController extends Controller
{
    protected $interviewScheduleRepository;

    public function __construct(InterviewScheduleRepository $interviewScheduleRepository)
    {
        $this->interviewScheduleRepository = $interviewScheduleRepository;
    }


    public function store(Request $request)
    {
        $request->validate([
            'interview_scheduling_date'=>'required',
            'interview_scheduling_time'=>'required',
            'user_id' => 'required',
        ]);
        //dd($request->all());
        $input = $request->only('recruitment_id', 'interview_scheduling_date','interview_scheduling_time','user_id');
        $user = $this->getUser();
        $data = $this->interviewScheduleRepository->insert($input,$user);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Interview schedule is successfully added!',
                    'alert-type' => 'success'
               );
               return redirect()->action('RecruitmentController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }

    public function interviewSchedulingEdit($id)
    {
        $data['recruitment'] = $this->interviewScheduleRepository->viewRecruitment($id);
        $data['schedule']    = $this->interviewScheduleRepository->viewSchedule($id);
        $data['interviewers'] = $this->interviewScheduleRepository->fetchUsersInterviewer();
        return view('Interview_scheduled.interview_scheduling_edit',$data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'interview_scheduling_date'=>'required',
            'interview_scheduling_time'=>'required',
            'user_id' => 'required',
        ]);
        $input = $request->only('recruitment_id', 'interview_scheduling_date','interview_scheduling_time','user_id');
        $data = $this->interviewScheduleRepository->updateSave($input,$id);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Interview schedule is successfully update!',
                    'alert-type' => 'success'
               );
               return redirect()->action('RecruitmentController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }


   

}
