<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LeaveBankRepository;


class LeavesBankController extends Controller
{
    protected $leaveBankRepository;

    public function __construct(LeaveBankRepository $leaveBankRepository)
    {
        $this->leaveBankRepository = $leaveBankRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['employees'] = $this->leaveBankRepository->getAllEmployees();
        if ($request->ajax()) {
            return $this->leaveBankRepository->getAll($input);
        } else {
            return view('leaves_bank.index',$data);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'number_of_leaves' => 'required',
        ]);
        $input = $request->all();
        $data = $this->leaveBankRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                 'message' => 'Leaves bank is successfully added!',
                 'alert-type' => 'success'
            );
            return redirect()->action('LeavesBankController@index')->with($notification);
        } else {
            return redirect()->back();
        }
        
    }
}
