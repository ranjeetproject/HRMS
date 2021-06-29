<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InterviewFeedbackContentRepository;


class InterviewFeedbackContentController extends Controller
{
    protected $interviewfeedbackcontentRepository;

    public function __construct(InterviewFeedbackContentRepository $interviewfeedbackcontentRepository)
    {
        $this->interviewfeedbackcontentRepository = $interviewfeedbackcontentRepository;
    }

    public function index()
    {
        $interview_feedback_contents = $this->interviewfeedbackcontentRepository->interview_feedback_content();
        return view('interview_feedback_content.index',compact('interview_feedback_contents'));
    }

    // public function selectionStore(Request $request)
    // {
    //     $request->validate([
    //         'content_for_selection' => 'required',
    //     ]);
    //     $input = $request->all();
    //     $data = $this->interviewfeedbackcontentRepository->insert($input);
    //     if ($data['success'] == true) {
    //         $notification = array(
    //             'message' => 'interview feedback content selection is successfully added!',
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->action('InterviewFeedbackContentController@index')->with($notification);
    //     } else {
    //         return redirect()->back();
    //     }
    // }

    public function rejectionStore(Request $request)
    {
        $request->validate([
            'content_for_rejection' => 'required',
        ]);
        $input = $request->all();
        $data = $this->interviewfeedbackcontentRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'interview feedback content rejection is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('InterviewFeedbackContentController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    // public function selectionUpdate(Request $request, $id)
    // {
    //     $request->validate([
    //         'content_for_selection' => 'required',
    //     ]);
    //     $input = $request->all();
    //     $data = $this->interviewfeedbackcontentRepository->updateSave($input,$id);
    //     if ($data['success'] == true) {
    //         $notification = array(
    //             'message' => 'interview feedback content selection is successfully Update!',
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->action('InterviewFeedbackContentController@index')->with($notification);
    //     } else {
    //         return redirect()->back();
    //     }
    // }

    public function rejectionUpdate(Request $request, $id)
    {
        $request->validate([
            'content_for_rejection' => 'required',
        ]);
        $input = $request->all();
        $data = $this->interviewfeedbackcontentRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'interview feedback content rejection is successfully Update!',
                'alert-type' => 'success'
            );
            return redirect()->action('InterviewFeedbackContentController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }
}
