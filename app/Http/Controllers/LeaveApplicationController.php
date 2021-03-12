<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LeaveApplicationRepository;


class LeaveApplicationController extends Controller
{

    protected $leaveApplicationRepository;

    public function __construct(LeaveApplicationRepository $leaveApplicationRepository)
    {
        $this->leaveApplicationRepository = $leaveApplicationRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $user = $this->getUser();
        if ($request->ajax()) {
             return $this->leaveApplicationRepository->getAll($input,$user);
        } else {
             return view('leave_application.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'application_type' => 'required',
            'reason' => 'required',
        ]);
        $input = $request->all();
        $user = $this->getUser();
        $data = $this->leaveApplicationRepository->insert($input,$user);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Leave application is successfully applied',
                'alert-type' => 'success'
            );
            return redirect()->action('LeaveApplicationController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $leaveData = $this->leaveApplicationRepository->view($id);
        return view('leave_application.show', compact('leaveData'));
    
    }

    public function destroy($id)
    {
        $this->leaveApplicationRepository->deleteSpecific($id);
        $notification = array(
            'message' => 'Leave Application Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->action('LeaveApplicationController@index')
            ->with($notification);
    }

}
