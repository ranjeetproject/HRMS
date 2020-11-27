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

   public function destroy($id)
   {
       $this->skillRepository->deleteSpecific($id);
       $notification = array(
           'message' => 'Skill Deleted successfully',
           'alert-type' => 'success'
       );
       return redirect()->action('SkillController@index')
           ->with($notification);
   }
}
