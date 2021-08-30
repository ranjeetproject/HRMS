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
        $data['user'] = $user;
        return view('team_member.index',$data);
        
    }

    public function store(Request $request){

        $request->validate([
            'team2' => 'required',
        ]);
        $input = $request->all();
        $user = $this->getUser();
        $data = $this->teamMemberRepository->insert($input,$user);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Team members is successfully added!',
                    'alert-type' => 'success'
               );
               return redirect()->action('TeamMemberController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }

    public function update(Request $request, $id){
        
       
        
        
        $input = $request->only('team2');

        $user = $this->getUser();
        $data = $this->teamMemberRepository->updateSave($input,$id,$user);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Team members is successfully Update!',
                    'alert-type' => 'success'
               );
               return redirect()->action('TeamMemberController@index')->with($notification);
           } else {
               return redirect()->back();
           }

    }
}
