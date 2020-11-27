<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RecruitmentRepository;
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
               'notice_period'=> 'required',
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

 
}
