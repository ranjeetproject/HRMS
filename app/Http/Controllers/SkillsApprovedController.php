<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SkillsApprovedRepository;


class SkillsApprovedController extends Controller
{
    protected $skillApprovedRepository;

    public function __construct(SkillsApprovedRepository $skillApprovedRepository)
    {
        $this->skillApprovedRepository = $skillApprovedRepository;
    }

    public function index()
    {
        $aquired_skills =  $this->skillApprovedRepository->fetchAquiredSkill();
        return view('skills_approved.index',compact('aquired_skills'));
    }

    public function approveAndDisapprove(Request $request)
    {
        if ($request->has('id') && $request->get('id') > 0 && $request->has('status_val') && $request->get('status_val') > 0) {
            $candidateId = $request->get('id');
            $statusId = $request->get('status_val');
            $candidateStatus = $this->skillApprovedRepository->approveAndDisapproveStatus($statusId,$candidateId);
                if($candidateStatus['success'] == true && $candidateStatus['status'] == 1){
                    return ['success' => true, 'message' => 'Skills Approved'];
                }else{
                    return ['success' => false, 'message' => 'Skills Disapproved'];
                }
        }else{
            return ['success' => false];

        } 

    }
}
