<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FinalRoundRepository;


class FinalRoundController extends Controller
{
    protected $finalRoundRepository;

    public function __construct(FinalRoundRepository $finalRoundRepository)
    {
        $this->finalRoundRepository = $finalRoundRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->finalRoundRepository->getAll($input);
        } else {
            return view('final_round.index');
        }
        
    }

    public function finalRoundInterviewScheduling($id)
    {
        $data['feedbackCandiate'] = $this->finalRoundRepository->fetchCandidateName($id);
        return view('final_round.create',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'recruitment_id' => 'required',
            'final_round_interview_scheduling_date'=>'required',
            'final_round_interview_scheduling_time'=>'required',
            'final_round_interview_user_id' => 'required',
        ]);
        $input = $request->only('recruitment_id','schedule_id','final_round_interview_scheduling_date','final_round_interview_scheduling_time','final_round_interview_user_id');
        $data = $this->finalRoundRepository->insert($input);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Final Round Interview schedule is successfully added!',
                    'alert-type' => 'success'
               );
               return redirect()->action('FinalRoundController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalRoundInterviewSchedulingEdit($id)
    {
        $data['final_round_schedule'] = $this->finalRoundRepository->fetchFinalRoundSchedule($id);
        return view('final_round.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'recruitment_id' => 'required',
            'final_round_interview_scheduling_date'=>'required',
            'final_round_interview_scheduling_time'=>'required',
            'final_round_interview_user_id' => 'required',
        ]);
        $input = $request->only('recruitment_id','final_round_interview_scheduling_date','final_round_interview_scheduling_time','final_round_interview_user_id');
        $data = $this->finalRoundRepository->updateSave($input,$id);
           if ($data['success'] == true) {
               $notification = array(
                    'message' => 'Final Round Interview schedule is successfully update!',
                    'alert-type' => 'success'
               );
               return redirect()->action('FinalRoundController@index')->with($notification);
           } else {
               return redirect()->back();
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
