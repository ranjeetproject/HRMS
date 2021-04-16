<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SkillAcquiredRepository;

class SkillsAcquiredController extends Controller
{
    protected $skillAcquiredRepository;

    public function __construct(SkillAcquiredRepository $skillAcquiredRepository)
    {
        $this->skillAcquiredRepository = $skillAcquiredRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $user  = $this->getUser();
        $data['skills'] =  $this->skillAcquiredRepository->fetchSkills();
        if ($request->ajax()) {
            return $this->skillAcquiredRepository->getAll($input,$user);
        } else {
            return view('skills_acquired.index',$data);
        }
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill' => 'required',
            'acquire_date' => 'required',
        ]);
        $user  = $this->getUser();
        $input = $request->all();
        $input['user_id'] = $user->id ;
        $input['employee_details_id'] = $user->employee_details_id ;
        $data  = $this->skillAcquiredRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                 'message' => 'Skills Acquired Up is successfully added!',
                 'alert-type' => 'success'
            );
            return redirect()->action('SkillsAcquiredController@index')->with($notification);
       } else {
            return redirect()->back();
       }

    }

    public function destroy($id)
    {
        $this->skillAcquiredRepository->deleteSpecific($id);
        $notification = array(
            'message' => 'Skills Acquired Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->action('SkillsAcquiredController@index')
            ->with($notification);
    }


    

}
