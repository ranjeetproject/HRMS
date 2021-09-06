<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TeamMemberRepository;


class TeamMemberController extends Controller
{
    protected $teamMemberRepository;

    public function __construct(TeamMemberRepository $teamMemberRepository)
    {
        $this->teamMemberRepository = $teamMemberRepository;
    }


    public function index(Request $request)
    {
        $user = $this->getUser();
        $data['members'] = $this->teamMemberRepository->allEmployees($user);
        $data['select_members'] = $this->teamMemberRepository->allSelected($user);
        $data['all_users'] = $this->teamMemberRepository->allMember();
        foreach($data['all_users'] as $val)
        {
            $allMember[] = $val->id;
        }
        $data['all_member'] = $allMember;
        $data['user'] = $user;
        return view('team_member.index',$data);
        
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user = $this->getUser();
        $data = $this->teamMemberRepository->insert($input,$user);
        if($data['success'] == true){
            return ['success' => true, 'message' => 'Team Member Successful Added'];
        }else{
            return ['success' => false, 'message' => 'Team Member Failed To Add'];
        }
    }

    public function update(Request $request, $id){
        
        $input = $request->all();
        $user = $this->getUser();
        $data = $this->teamMemberRepository->updateSave($input,$id,$user);
        if($data['success'] == true){
            return ['success' => true, 'message' => 'Team Member Successful Update'];
        }else{
            return ['success' => false, 'message' => 'Team Member Failed To Update'];
        }

    }
}
