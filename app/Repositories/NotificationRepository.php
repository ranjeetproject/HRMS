<?php

namespace App\Repositories;

use App\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NotificationRepository
{
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