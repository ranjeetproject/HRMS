<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RecruitmentRepository;
use Illuminate\Support\Facades\URL;
use Validator,Redirect,Response;


class RecruitmentController extends Controller
{
     protected $recruitmentRepository;

    public function __construct(RecruitmentRepository $recruitmentRepository)
    {
        $this->recruitmentRepository = $recruitmentRepository;
    }
     public function index(Request $request)
     {
          $input = $request->all();
          if ($request->ajax()) {
               return $this->recruitmentRepository->getAll($input);
          } else {
               return view('recruitments.index');
          }
         
     }
    
     public function create()
     {
          $skills =  $this->recruitmentRepository->fetchSkills();
          return view('recruitments.create',compact('skills'));
     }

     public function store(Request $request)
     {
          $request->validate([
               'name_of_candidate' => 'required',
               'mobile_number'=>'required',
               'alternate_number' => 'required',
               'total_years_experience' => 'required',
               'total_months_experience' => 'required',
               'address' => 'required',
               'relevent_years_experience' => 'required',
               'relevent_months_experience'=> 'required',
               'email_id'=> 'required',
               'application_for'=> 'required',
               'highest_qualification'=> 'required',
               'current_ctc'=> 'required',
               'expected_ctc'=> 'required',
               'current_location'=> 'required',
               'skill'=> 'required',
               'notice_period'=> 'required|numeric',
               'reffered_by'=> 'required',
               'special_remarks'=> 'required',
           ]);
          
           $input = $request->all();
           $data = $this->recruitmentRepository->insert($input);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Recruitment is successfully added!',
                    'alert-type' => 'success'
               );
               return redirect()->action('RecruitmentController@index')->with($notification);
           } else {
               return redirect()->back();
           }


     }

     public function show($id)
     {
          $recruitment = $this->recruitmentRepository->view($id);
          return view('recruitments.show',compact('recruitment'));
     }


     public function edit($id)
     {
          $skilldata = array();
          $data['recruitment'] = $this->recruitmentRepository->viewEdit($id);
          $data['skills'] =  $this->recruitmentRepository->fetchSkills();
          $data['recruitmentSkills'] =  $this->recruitmentRepository->fetchRecruitmentSkills($id);
          foreach($data['recruitmentSkills'] as $key => $val)
          {
             $skilldata[] = $val['skill_id'];
          }
          return view('recruitments.edit',$data,compact('skilldata'));
     }

     public function update(Request $request, $id)
     {
          $request->validate([
               'name_of_candidate' => 'required',
               'mobile_number'=>'required',
               'alternate_number' => 'required',
               'total_years_experience' => 'required',
               'total_months_experience' => 'required',
               'address' => 'required',
               'relevent_years_experience' => 'required',
               'relevent_months_experience'=> 'required',
               'email_id'=> 'required',
               'application_for'=> 'required',
               'highest_qualification'=> 'required',
               'current_ctc'=> 'required',
               'expected_ctc'=> 'required',
               'current_location'=> 'required',
               'skill'=> 'required',
               'notice_period'=> 'required|numeric',
               'reffered_by'=> 'required',
               'special_remarks'=> 'required',
           ]);
          
           $input = $request->all();
           $data = $this->recruitmentRepository->updateSave($input,$id);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Recruitment is successfully update!',
                    'alert-type' => 'success'
               );
               return redirect()->action('RecruitmentController@index')->with($notification);
           } else {
               return redirect()->back();
           }
     }

     public function destroy($id)
     {
         $this->recruitmentRepository->deleteSpecific($id);
         $notification = array(
             'message' => 'Recruitment Deleted successfully',
             'alert-type' => 'success'
         );
         return redirect()->action('RecruitmentController@index')
             ->with($notification);
     }

     public function interviewScheduling($id)
     {
          $data['recruitment'] = $this->recruitmentRepository->viewEdit($id);
          $data['schedule']    = $this->recruitmentRepository->viewSchedule($id);
          return view('Interview_scheduled.interview_scheduling',$data);
     }

     public function interviewFeedback($id)
     {
          $data['recruitment'] = $this->recruitmentRepository->viewEdit($id);
          $data['schedule']    = $this->recruitmentRepository->viewSchedule($id);
          $data['feedback']    = $this->recruitmentRepository->viewFeedback($id);
          return view('Interview_scheduled.interview_feedback',$data);
     }
 
}
