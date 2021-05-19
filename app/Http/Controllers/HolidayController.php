<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HolidayRepository;


class HolidayController extends Controller
{
    protected $holidayRepository;

    public function __construct(HolidayRepository $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }

    public function index(Request $request)
    {
        $data = [];
        $input = $request->all();
        $user = $this->getUser();
        $user_permissions =  $this->holidayRepository->checkPermission($user);
        foreach($user_permissions as $user_permission){
            $data['user_permissions'] = $user_permission;
        }
        if ($request->ajax()) {
            return $this->holidayRepository->getAll($input);
        } else {
            return view('holiday.index',$data);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'holiday_name' => 'required',
            'holiday_date'=>'required',
        ]);
        $input = $request->only('holiday_name','holiday_date');
        $data = $this->holidayRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                 'message' => 'Holiday is successfully added!',
                 'alert-type' => 'success'
            );
            return redirect()->action('HolidayController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $this->holidayRepository->deleteSpecific($id);
        $notification = array(
            'message' => 'Holiday Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->action('HolidayController@index')
            ->with($notification);
    }


}
