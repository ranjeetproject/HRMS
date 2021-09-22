<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeExtraHalfDayLeavesDetailsRepository;


class EmployeeExrtaHalfDayLeaveDetails extends Controller
{
    protected $extraHalfDayLeavesDetailsRepository;

    public function __construct(EmployeeExtraHalfDayLeavesDetailsRepository $extraHalfDayLeavesDetailsRepository)
    {
        $this->extraHalfDayLeavesDetailsRepository = $extraHalfDayLeavesDetailsRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->extraHalfDayLeavesDetailsRepository->getAll($input);
        } else {
            return view('extra_and_halfday_leaves_details.index');

        }
    }

    public function destroy($id)
    {
        $data = $this->extraHalfDayLeavesDetailsRepository->updateSave($id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Deleted successfully',
                'alert-type' => 'success'
            );
            return redirect()->action('EmployeeExrtaHalfDayLeaveDetails@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }
}
