<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PerformanceFeedbackRepository;


class PerformanceFeedbackController extends Controller
{
    protected $performanceFeedbackRepository;

    public function __construct(PerformanceFeedbackRepository $performanceFeedbackRepository)
    {
        $this->performanceFeedbackRepository = $performanceFeedbackRepository;
    }
    
    public function index(Request $request)
    {
        $user = $this->getUser();
        $data['team_member_name'] = $this->performanceFeedbackRepository->fetchTeamMember($user);
        $input = $request->all();
        if ($request->ajax()) {
            return $this->performanceFeedbackRepository->getAll($input);
        } else {
            return view('performance_feedback.index',$data);
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_member_name_id' => 'required',
            'performance_type'=>'required',
            'review_date'=>'required',
            'description'=>'required',

        ]);
        $input = $request->all();
        $data = $this->performanceFeedbackRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Performance feedback is successfully added',
                'alert-type' => 'success'
            );
            return redirect()->action('PerformanceFeedbackController@index')->with($notification);
        } else {
            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        $this->performanceFeedbackRepository->deleteSpecific($id);
        $notification = array(
            'message' => 'Performance Feedback Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->action('PerformanceFeedbackController@index')
            ->with($notification);
    }
}
