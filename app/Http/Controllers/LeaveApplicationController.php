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
        $data['employees_manager'] = $this->leaveApplicationRepository->getTeamHead($user);
        if ($request->ajax()) {
             return $this->leaveApplicationRepository->getAll($input,$user);
        } else {
             return view('leave_application.index',$data);
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
        if($input['from_date'] > $input['to_date']){
            $notification = array(
                'message' => 'From Date is Greater Than To Date',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
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

    public function AllEmployessBankLeavesDetails()
    {
        $employee_leaves_data = [];
        $yearsMonths = $this->leaveApplicationRepository->yearMonths();
        $employess = $this->leaveApplicationRepository->employessDetails();
        foreach($employess as $i => $val){
            $employee_leaves_data[$i]['employee_name'] = $val->name;
            $employee_leaves_data[$i]['twd'] = $this->leaveApplicationRepository->TotalWorkDetail();
            $employee_leaves_data[$i]['applicationNotApplied'] = $this->leaveApplicationRepository->remainingNotApplicationApplied($val->id);
            $employee_leaves_data[$i]['applicationNotApproved'] = $this->leaveApplicationRepository->applicationNotApproved($val->id);
            $employee_leaves_data[$i]['totalworkingdays'] = $this->leaveApplicationRepository->TotalWorkingDaysDetail($val->id);
            $employee_leaves_data[$i]['numberoffs'] = $this->leaveApplicationRepository->TotalNumberOffs($val->id);
            $employee_leaves_data[$i]['numberapprove'] = $this->leaveApplicationRepository->TotalNumberOfApproveLeaves($val->id);
            $employee_leaves_data[$i]['extra_work'] = $this->leaveApplicationRepository->TotalNumberOfExtraWorkApprove($val->id);
            $employee_leaves_data[$i]['half_day_work'] = $this->leaveApplicationRepository->TotalNumberOfHalfDaysWorkApprove($val->id);
            $employee_leaves_data[$i]['salary_deduction'] = $this->leaveApplicationRepository->TotalNumberOfNotApproveLeavesSalaryDeduction($val->id);
        
        }
        return view('leave_application.all_employee_leaves_bank',compact('employee_leaves_data','yearsMonths'));
        
    }

    public function MonthAndYearWiseLeaves(Request $request)
    {
        $input = $request->only('monthAndYear');
        $data = explode(" ",$input['monthAndYear']);
        if(count($data)>1){
            $month = ($data[0]>=10)?$data[0]:'0'.$data[0];
            $year = $data[1];
        }else{
            $month = date('m');
            $year = date('Y');
        }
        $employee_leaves_data = [];
        $yearsMonths = $this->leaveApplicationRepository->yearMonths();
        $employess   = $this->leaveApplicationRepository->employessDetails();
        foreach($employess as $i => $val){
            $employee_leaves_data[$i]['employee_name'] = $val->name;
            $employee_leaves_data[$i]['twd'] = $this->leaveApplicationRepository->TotalWorkDetailSearch($month,$year);
            $employee_leaves_data[$i]['applicationNotApplied'] = $this->leaveApplicationRepository->remainingNotApplicationAppliedSearch($val->id,$month,$year);
            $employee_leaves_data[$i]['applicationNotApproved'] = $this->leaveApplicationRepository->applicationNotApprovedSearch($val->id,$month,$year);
            $employee_leaves_data[$i]['totalworkingdays'] = $this->leaveApplicationRepository->TotalWorkingDaysDetailSearch($val->id,$month,$year);
            $employee_leaves_data[$i]['numberoffs'] = $this->leaveApplicationRepository->TotalNumberOffsSearch($val->id,$month,$year);
            $employee_leaves_data[$i]['numberapprove'] = $this->leaveApplicationRepository->TotalNumberOfApproveLeavesSearch($val->id,$month,$year);
            $employee_leaves_data[$i]['extra_work'] = $this->leaveApplicationRepository->TotalNumberOfExtraWorkApproveSearch($val->id,$month,$year);
            $employee_leaves_data[$i]['half_day_work'] = $this->leaveApplicationRepository->TotalNumberOfHalfDaysWorkApproveSearch($val->id,$month,$year);
            $employee_leaves_data[$i]['salary_deduction'] = $this->leaveApplicationRepository->TotalNumberOfNotApproveLeavesSalaryDeductionSearch($val->id,$month,$year);
        }
        return view('leave_application.all_employee_leaves_bank',compact('employee_leaves_data','yearsMonths'));
    }


}
