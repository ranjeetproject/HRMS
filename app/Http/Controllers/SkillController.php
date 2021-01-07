<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SkillRepository;


class SkillController extends Controller
{

    protected $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->skillRepository->getAll($input);
        } else {
            return view('skills.index');
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required',
        ]);
        $input = $request->all();
        $data = $this->skillRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Skill is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('SkillController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $skill = $this->skillRepository->viewEdit($id);
        return view('skills.edit',compact('skill'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'skill_name' => 'required',
        ]);
        $input = $request->all();
        $data = $this->skillRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Skill is successfully update!',
                'alert-type' => 'success'
            );
            return redirect()->action('SkillController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

   public function destroy($id)
   {
       $data = $this->skillRepository->deleteSpecific($id);
       if ($data['success'] == true) {
            $notification = array(
                'message' => 'Skill Deleted successfully',
                'alert-type' => 'success'
            );
            return redirect()->action('SkillController@index')
                ->with($notification);
       }else{
        $notification = array(
            'message' => 'Skill already Selected',
            'alert-type' => 'success'
        );
        return redirect()->action('SkillController@index')
        ->with($notification);
       }

    
   }
}
