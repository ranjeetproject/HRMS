<?php


namespace App\Repositories;

use App\InterviewFeedback;
use App\Recruitment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;



class RejectedRepository
{
    public function getAll()
    {
        $data = InterviewFeedback::orderBy('interview_feedback.created_at', 'DESC')
                ->leftJoin('recruitments','recruitments.id','=','interview_feedback.recruitment_id')
                ->where('interview_feedback.active','=',2)
                ->get([
                    'interview_feedback.id','recruitments.name_of_candidate','recruitments.mobile_number','recruitments.email_id',
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
}

   