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
        if ($request->has('id') && $request->get('id') > 0 && $request->has('status_val') && $request->get('status_val') > 0) {
            $btnId = $request->get('id');
            $statusId = $request->get('status_val');
            $leaveStatus = $this->pendingApprovalRepository->approveAndRejectedStatus($btnId,$statusId);
                if($leaveStatus['success'] == true && $leaveStatus['status'] == 1){
                    return ['success' => true, 'message' => 'Approved'];
                }else{
                    return ['success' => false, 'message' => 'Rejected'];
                }
        
            
        }
    }
}
