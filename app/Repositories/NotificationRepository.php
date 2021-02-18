<?php

namespace App\Repositories;

use App\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NotificationRepository
{
    public function getAll($inputData)
    {
        $data = Notification::orderBy('created_at', 'DESC')->get([
            'id', 'text','view_url','created_at'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '';

                return $html;
            })
            ->addColumn('created_at', function ($row) use ($inputData) {
                if ($row->created_at != '') {
                    return $row->created_at;
                }

            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function insert($inputData)
    {
        $row = Notification::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}