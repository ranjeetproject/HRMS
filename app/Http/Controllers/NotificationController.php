<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NotificationRepository;


class NotificationController extends Controller
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }
    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->notificationRepository->getAll($input);
        } else {
            return view('notification.index');
        }

    }
}
