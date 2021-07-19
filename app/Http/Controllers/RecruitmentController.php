<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
          $data = [];
          $input = $request->all();
          $user = $this->getUser();
          $user_permissions =  $this->recruitmentRepository->checkPermission($user);
          //dd($user_permissions);
          foreach($user_permissions as $user_permission){
               $data['user_permissions'] = $user_permission;
          }
          if ($request->ajax()) {
               return $this->recruitmentRepository->getAll($input);
          } else {
               return view('recruitments.index',$data);
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
               'mobile_number'=>'required|numeric',
               'total_years_experience' => 'required',
               'total_months_experience' => 'required',
               'email_id'=> 'required|email',
               'application_for'=> 'required',
               'current_ctc'=> 'required',
               'expected_ctc'=> 'required',
               'skill'=> 'required',
               'notice_period'=> 'required|numeric',
               'upload_resume' => 'required|mimes:doc,docx,pdf'
           ]);
          
           $input = $request->all();
           if ($request->hasFile('upload_resume')){
               $rand_val           = date('YMDHIS') . rand(11111, 99999);
               $image_file_name    = md5($rand_val);
               $file               = $request->file('upload_resume');
               $fileExt            = $file->getClientOriginalExtension();
               if($fileExt=='pdf' ||  $fileExt =='docx'|| $fileExt =='doc')
               {
                 $fileName           = $image_file_name.'.'.$fileExt;
                 $destinationPath    = public_path().'/upload_resume';
                 $file->move($destinationPath,$fileName);
                 $input['upload_resume']    = $fileName ;
               }else{
                    
                    return redirect()->back();
               }
          }
          $user = $this->getUser();
          $data = $this->recruitmentRepository->insert($input,$user);
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
               'mobile_number'=>'required|numeric',
               'total_years_experience' => 'required',
               'total_months_experience' => 'required',
               'email_id'=> 'required|email',
               'application_for'=> 'required',
               'current_ctc'=> 'required',
               'expected_ctc'=> 'required',
               'skill'=> 'required',
               'notice_period'=> 'required|numeric',
           ]);
          
           $input = $request->all();
           if ($request->hasFile('upload_resume')){
               $rand_val           = date('YMDHIS') . rand(11111, 99999);
               $image_file_name    = md5($rand_val);
               $file               = $request->file('upload_resume');
               $fileExt            = $file->getClientOriginalExtension();
               if($fileExt=='pdf' ||  $fileExt =='doc')
               {
                 $fileName           = $image_file_name.'.'.$fileExt;
                 $destinationPath    = public_path().'/upload_resume';
                 $file->move($destinationPath,$fileName);
                 $input['upload_resume']    = $fileName ;
               }
          }
         
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
          $user = $this->getUser();
          $this->recruitmentRepository->deleteSpecific($id,$user);
          $notification = array(
             'message' => 'Recruitment Deleted successfully',
             'alert-type' => 'success'
           );
          return redirect()->action('RecruitmentController@index')
             ->with($notification);
     }

     public function downloadfile($file)
     {
          $file= public_path()."/upload_resume/".$file;
          return response()->download($file);
     }

     public function interviewScheduling($id)
     {
          $data['recruitment'] = $this->recruitmentRepository->viewEdit($id);
          $data['schedule']    = $this->recruitmentRepository->viewSchedule($id);
          $data['interviewers'] = $this->recruitmentRepository->fetchUsersInterviewer();
          return view('Interview_scheduled.interview_scheduling',$data);
     }

     public function interviewFeedback($id)
     {
          $data['recruitment'] = $this->recruitmentRepository->viewEdit($id);
          $data['schedule']    = $this->recruitmentRepository->viewSchedule($id);
          $data['feedback']    = $this->recruitmentRepository->viewFeedback($id);
          $data['interviewers'] = $this->recruitmentRepository->fetchUsersInterviewer();
          return view('Interview_scheduled.interview_feedback',$data);
     }
 
}
