<?php
namespace App\Repositories;

use App\Holiday;
use App\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class HolidayRepository
{
    public function getAll()
    {
        $data = Holiday::orderBy('created_at', 'DESC')
        ->whereYear('created_at', Carbon::now()->year)
        ->get([
            'id', 'holiday_name',
            DB::raw('date_format(holiday_date,"%d-%M-%Y") as monthName'),
            'holiday_date'
        ]);
       // dd($data->holiday_date);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<form method="POST" action="' . action('HolidayController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
                onsubmit="return confirm(\'Are you sure want to delete this row?\');"><input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
                        </form> ';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function insert($inputData)
    {
        $inputData['holiday_date'] = date('Y-m-d',strtotime($inputData['holiday_date']));
        $row = Holiday::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id)
    {
        if ($id > 0) {
            $row = Holiday::find($id);
            if ($row) {
                $row->delete();
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }

    public function checkPermission($user)
    {
        $row = UserPermission::Where('department_id','=',$user->department_id)->Where('designation_id','=',$user->designation_id)->get();
        return $row;
    }

    public function yearMonths(){
        $data = array();
        for ($i = 11; $i >= 0; $i--) {
            $month_number = Carbon::today()->subMonth($i);
            $month = Carbon::today()->subMonth($i);
            $year = Carbon::today()->subMonth($i)->format('Y');
            array_push($data, array(
                'month_number' => $month_number->month,
                'month' => $month->shortMonthName,
                'year' => $year
            ));
        }
        return $data;     
    }

}