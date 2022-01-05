<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PendingApprovalRepository;


class PendingApprovalController extends Controller
{
    protected $pendingApprovalRepository;

    public function __construct(PendingApprovalRepository $pendingApprovalRepository)
    {
        $this->pendingApprovalRepository = $pendingApprovalRepository;
    }

    public function index(Request $request)
    {
        $appliedLeaves =  $this->pendingApprovalRepository->fetchAppliedLeave();
        //dd(compact('appliedLeaves'));
        return view('leave_pending_approvals.index',compact('appliedLeaves'));
    }

    public function approveAndRejectedLeave(Request $request)
    {
        if ($request->has('btn_id') && $request->get('btn_id') > 0 && $request->has('leave_application_id') && $request->get('leave_application_id') > 0 
            && $request->has('leave_application_type') && $request->get('leave_application_type') > 0 && $request->has('from_date') && $request->get('from_date') > 0 
            && $request->has('to_date') && $request->get('to_date') > 0 && $request->has('user_id') && $request->get('user_id') > 0) {
            $btnId = $request->get('btn_id');
            $leaveApplicationId = $request->get('leave_application_id');
            $leaveApplicationType = ($request->get('leave_application_type'))?$request->get('leave_application_type'):null;
            $leaveApplicationFromDate = ($request->get('from_date'))?$request->get('from_date'):null;
            $leaveApplicationToDate = ($request->get('to_date'))?$request->get('to_date'):null;
            $userId = ($request->get('user_id'))?$request->get('user_id'):null;
            $leaveStatus = $this->pendingApprovalRepository->approveAndRejectedStatus($btnId,$leaveApplicationId,$leaveApplicationType,$leaveApplicationFromDate,$leaveApplicationToDate,$userId);
                if($leaveStatus['success'] == true && $leaveStatus['status'] == 1){
                    return ['success' => true, 'message' => 'Approved'];
                }else{
                    return ['success' => false, 'message' => 'Rejected'];
                }
        
            
        }
    }
}
