<?php


namespace App\Repositories;

namespace App\Repositories;

use App\LeaveApplication;
use App\LeavesBank;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class LeaveBankRepository
{
    public function getAll()
    {
        $data = LeavesBank::orderBy('leaves_banks.created_at', 'DESC')
        ->leftJoin('users','users.id','=','leaves_banks.user_id')
        ->get([
            'leaves_banks.id', 'leaves_banks.date','users.name','leaves_banks.number_of_leaves'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function getAllEmployees()
    {
        $data = User::orderBy('created_at', 'DESC')
        ->where('id','!=',1)
        ->get(['id','name']);
        return $data;
    }

    public function insert($inputData)
    {
        $row = LeavesBank::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

}
